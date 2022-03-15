@extends('revise-operation::fields.abstract-field', ['revision_field'=>$revision_field])

@section('extend-params')
@php
    $class_body = !isset($class_body) ? 'card-body' : $class_body;

    $date = date('h:ia', strtotime($revision_field->created_at));
    $user_name = $revision_field->userResponsible()?$revision_field->userResponsible()->name:trans('revise-operation::revise.guest_user');
    $field = $revision_field->fieldName();
@endphp
@overwrite

@section('field-body')
{{--    Header manage in abstract-field view    --}}
<div class="{{$class_body}}">
    <div class="row">
        <div class="col-md-3">{{ mb_ucfirst(trans('revise-operation::revise.from')) }}:</div>
        <div class="col-md-6">{{ mb_ucfirst(trans('revise-operation::revise.to')) }}:</div>
    </div>
    <div class="row">
        <div class="col-md-3"><div class="alert alert-default" style="overflow: hidden;">{{ $revision_field->oldValue() }}</div></div>
        <div class="col-md-9"><div class="alert alert-success" style="overflow: hidden;">{{ $revision_field->newValue() }}</div></div>
    </div>
</div>
@overwrite