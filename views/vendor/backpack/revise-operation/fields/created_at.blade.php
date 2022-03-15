@extends('revise-operation::fields.abstract-field')

@section('extend-params')
@php
    $date = date('h:ia', strtotime($revision_field->created_at));
    $user_name = $revision_field->userResponsible() ? $revision_field->userResponsible()->name : trans('revise-operation::revise.guest_user');
    $field = $crud->entity_name;
@endphp
@overwrite

@section('field-body')
@overwrite