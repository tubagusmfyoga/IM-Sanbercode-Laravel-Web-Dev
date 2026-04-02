@extends('layouts.master')
@section('title', 'Register')
@section('judul',)
Register
@endsection 
@section('content')
    <form action="/welcome" method="POST" >
        @csrf
      <label for="first-name">First Name:</label><br /><br />
      <input type="text" id="first-name" name="first-name" /><br /><br />
      <label for="last-name">Last Name:</label><br /><br />
      <input type="text" id="last-name" name="last-name" /><br /><br />
      <label for="gender">Gender:</label><br /><br />
      <input type="radio" id="male" name="gender" value="male" />
      <label for="male">Male</label><br />
      <input type="radio" id="female" name="gender" value="female" />
      <label for="female">Female</label><br />
      <input type="radio" id="other" name="gender" value="other" />
      <label for="other">Other</label><br /><br />
      <label for="nationality">Nationality:</label><br /><br />
      <select id="nationality" name="nationality">
        <option value="indonesian">Indonesian</option>
        <option value="singapore">Singapore</option>
        <option value="malaysia">Malaysian</option>
        <option value="australia">Australian</option></select
      ><br /><br />
      <label for="language">Language Spoken:</label><br /><br />
      <input
        type="checkbox"
        id="bahasa-indonesia"
        name="language"
        value="bahasa-indonesia"
      />
      <label for="bahasa-indonesia">Bahasa Indonesia</label><br />
      <input type="checkbox" id="english" name="language" value="english" />
      <label for="english">English</label><br />
      <input
        type="checkbox"
        id="other-language"
        name="language"
        value="other-language"
      />
      <label for="other-language">Other</label><br /><br />
      <label for="bio">Bio:</label><br /><br />
      <textarea id="bio" name="bio" rows="10" cols="30"></textarea><br />
      <input type="submit" value="Sign Up" />
    </form>
@endsection
