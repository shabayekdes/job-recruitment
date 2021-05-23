@component('mail::message')
# Introduction

The term name: **{{ $term }}**
The post ID: **{{ $id }}**


Thanks,<br>
{{ config('app.name') }}
@endcomponent
