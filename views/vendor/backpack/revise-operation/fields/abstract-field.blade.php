@php
    $class_header = !isset($class_header) ? 'card-header' : $class_header;

    $span_bases = "p-3 d-inline-block";
    $span_border = "border border-light border-left-0 border-top-0 border-bottom-0 border-end-1";//border-left is migrated to border-start in current doc.

    $class_text_old = 'text-normal';
    $class_text_new = 'text-success';
    $revision_field = null;

    $icon_date = "la la-clock";
    $icon_user = "la la-user";
    $icon_fieldvalue = "la la-angle-right";

    $label_field = isset($label_field) ? $label_field : trans('revise-operation::revise.changed_the');
    $label_from = isset($label_from) ? $label_from : mb_ucfirst(trans('revise-operation::revise.from'));
    $label_to = isset($label_to) ? $label_to : mb_ucfirst(trans('revise-operation::revise.to'));
@endphp

@yield('extend-params')


<div class="{{$class_header}} border-0 p-0">

    @isset($date)
    <span class="{{$span_bases}} {{$span_border}} bg-light">
        <strong class="time"><i class="{{$icon_date}}"></i> {{ $date }}</strong>
    </span>
    @endisset

    @isset($user_name)
    <span class="{{$span_bases}} {{$span_border}}">
        <i class="{{$icon_user}}"></i> <strong>{{ $user_name }}</strong>
    </span>
    @endif

    @isset($field)
    <span class="{{$span_bases}} {{$span_border}}">
        {{$label_field}}
        <strong>{{ $field }}</strong>
    </span>
    @endisset

    @isset($oldValue)
    <span class="{{$span_bases}} {{$class_text_old}}">
        <span class="px-2">{{ $label_from }}</span>&nbsp;<i class="{{$icon_fieldvalue}}"></i>
    </span>
    <span class="d-inline-block {{$class_text_old}}">
        {{ $oldValue }}
    </span>
    @endisset

    @isset($newValue)
    <span class="{{$span_bases}} {{$class_text_new}}">
        <span class="px-2">{{ $label_to }}</span> <i class="{{$icon_fieldvalue}}"></i>
    </span>
    <span class="d-inline-block {{$class_text_new}}">
        &nbsp{{ $newValue }}
    </span>
    @endisset

    {{--Check if crud vars are passede correctly--}}
    @include('revise-operation::revision-actions')
</div>

@yield('field-body')

