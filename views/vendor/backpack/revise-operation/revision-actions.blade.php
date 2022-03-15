@if (backpack_user()->can('revise') && backpack_user()->can('change-history'))
    <div class="card-header-actions">
        <form class="card-header-action" method="post" action="{{ url(\Request::url().'/'.$revision_field->id.'/restore') }}">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-outline-danger btn-sm restore-btn" data-entry-id="{{ $entry->id }}" data-revision-id="{{ $revision_field->id }}" onclick="onRestoreClick(event)">
                <i class="la la-undo"></i> {{ trans('revise-operation::revise.undo') }}</button>
        </form>
    </div>
@endif

@section('after_scripts')
    @if (backpack_user()->can('revise') && backpack_user()->can('change-history'))
    <script type="text/javascript">
        $.ajaxPrefilter(function(options, originalOptions, xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
            }
        });
        function onRestoreClick(e) {
            e.preventDefault();
            var entryId = $(e.target).attr('data-entry-id');
            var revisionId = $(e.target).attr('data-revision-id');
            $.ajax('{{ url(\Request::url()).'/' }}' +  revisionId + '/restore', {
                method: 'POST',
                data: {
                    revision_id: revisionId
                },
                success: function(revisionTimeline) {
                    // Replace the revision list with the updated revision list
                    $('#timeline').replaceWith(revisionTimeline);

                    // Animate the new revision in (by sliding)
                    $('.timeline-item-wrap').first().addClass('fadein');

                    // Show a green notification bubble
                    new Noty({
                        type: "success",
                        text: "{{ trans('revise-operation::revise.revision_restored') }}"
                    }).show();
                },
                error: function(data) {
                    // Show a red notification bubble
                    new Noty({
                        type: "error",
                        text: data.responseJSON.message
                    }).show();
                }
            });
        }
    </script>
    @endif
@endsection