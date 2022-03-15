@extends('revise-operation::fields.abstract-field')
@php
    $date = date('h:ia', strtotime($entry->created_at));
    $user_name = $entry->user ? $entry->user->name : trans('revise-operation::revise.guest_user');
    $field = $crud->entity_name;

    $label_field = trans('revise-operation::revise.created_this');
@endphp

@section('field-body')
@overwrite