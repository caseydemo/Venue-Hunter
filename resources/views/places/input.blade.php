@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
@endsection

@section('content')
<body>

<h1>Club Hunter!</h1>

<form action="/" method="post">
        <input style="text-align:center" type="hidden" name="_token" value="{{ csrf_token() }}">
        <ul><strong>City: <input type="text" name="city"><br></strong></ul>
        <ul><strong>State: <input type="text" name="state"><br></strong></ul>
        <ul><strong>Keyword: <input type="text" name="keyword"><br></strong></ul>
        <input type="submit">
    </form>

</body>
@endsection