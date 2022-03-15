@php
    $class_header = !isset($class_header) ? 'card-header' : $class_header;
    $class_body = !isset($class_body) ? 'card-body' : $class_body;
@endphp
{{-- Section header ?--}}
<div class="{{$class_header}}">
    <strong class="time"><i class="la la-clock"></i> {{ date('h:ia', strtotime($revision_field->created_at)) }}</strong> -
    {{ $revision_field->userResponsible()?$revision_field->userResponsible()->name:trans('revise-operation::revise.guest_user') }} {{ trans('revise-operation::revise.created_this') }} {{ $crud->entity_name }}
</div>