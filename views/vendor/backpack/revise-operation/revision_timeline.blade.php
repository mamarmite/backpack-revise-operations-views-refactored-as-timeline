
<div id="timeline">
    <div class="row">
    @php
        $creation_was_registered = false;
    @endphp
    @foreach($revisions as $revisionDate => $dateRevisions)
        <div class="col-12 py-3">
            <h5 class="text-primary">
                {{ Carbon\Carbon::parse($revisionDate)->isoFormat(config('backpack.base.default_date_format_iso')) }}
            </h5>
        </div>
        <div class="col-12 px-3">
            <div class="border-left border-primary ml-3 pl-3">
            @foreach($dateRevisions as $history)
                @php
                    $length_old = strlen($history->oldValue());
                    $length_new = strlen($history->newValue());
                    $small_limit = 100;
                    $average_length = $length_old + $length_new / 2;
                    $revision_params = ['revision_field' => $history];
                    //var :
                    //$revision_field as history.
                    //revision class main : "card-header"
                    //// && !$history->old_value
                @endphp
                <div class="d-flex flex-row justify-content-center align-items-center mb-3 pb-3">
                    <div class="p-3 mr-3 rounded-circle bg-primary text-center w-auto d-flex align-items-center" style="margin-left: -2.5em;">
                        <i class="la la-angle-right"></i>
                    </div>
                    <div class="card timeline-item-wrap w-100 p-0 m-0">
                        @if($history->key == 'created_at')
                            @include('revise-operation::fields.created_at', $revision_params)
                            @php
                                $creation_was_registered =true;
                            @endphp
                        @else
                            @if ($average_length < $small_limit)
                                @include('revise-operation::fields.smalltext', $revision_params)
                            @endif
                            @if ($average_length >= $small_limit)
                                @include('revise-operation::fields.longtext', $revision_params)
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
    @if (!$creation_was_registered)
        <div class="col-12 py-3">
            <h5 class="text-primary">
                {{ Carbon\Carbon::parse($entry->created_at)->isoFormat(config('backpack.base.default_date_format_iso')) }}
            </h5>
        </div>
        <div class="col-12 px-3">
            <div class="border-left border-primary ml-3 pl-3">
                {{--    Dry field container ?   --}}
                <div class="d-flex flex-row justify-content-center align-items-center mb-3 pb-3">
                    <div class="p-3 mr-3 rounded-circle bg-primary text-center w-auto d-flex align-items-center" style="margin-left: -2.5em;">
                        <i class="la la-angle-right"></i>
                    </div>
                    <div class="card timeline-item-wrap w-100 p-0 m-0">
                        @include('revise-operation::fields.entry-created_at', ['entry' => $entry])
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>


@section('after_styles')
    {{-- Animations for new revisions after ajax calls --}}
    <style>
        .timeline-item-wrap.fadein {
            -webkit-animation: restore-fade-in 3s;
            animation: restore-fade-in 3s;
        }
        @-webkit-keyframes restore-fade-in {
            from {opacity: 0}
            to {opacity: 1}
        }
        @keyframes restore-fade-in {
            from {opacity: 0}
            to {opacity: 1}
        }
    </style>
@endsection
