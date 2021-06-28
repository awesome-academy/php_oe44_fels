<h4>{{$offer['title']}},</h4>
<span>
@php 
  $body = explode('*', $offer['body']);

  foreach ($body as $item){
      echo "$item <br>";
  }
@endphp
</span>
<br>
Thanks,<br>
{{ config('app.name') }}
<br>
<br>
<span>
    Email: fels.sun@gmail.com <br>
    Holine: 03334443434
</span>
