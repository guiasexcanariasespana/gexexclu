@php
$encryptionPassphrase = config('app.tpvsecret');
  $concept = "CE-" . $anuncio->user->id . "-" . $anuncio->id . "-" . $plan->id;
  $test = config('app.tpv_test');
  $bizum = 0;
  $value = $concept .  number_format($precio, 2, '.', ' ')  . "canariasexclusiva.com" . $anuncio->user->id . $anuncio->id . $plan->id . $option . $test . $bizum ;
  
  $firma = sha1($value . $encryptionPassphrase);
@endphp
<a href="https://www.ideascanarias.com/tpv.php?concept={{$concept}}&amount={{ number_format($precio, 2, '.', ' ') }}&fromDomain=canariasexclusiva.com&userId={{$anuncio->user->id}}&adId={{$anuncio->id}}&planId={{$plan->id}}&optionDescription={{$option}}&test={{$test}}&bizum={{$bizum}}&signature={{$firma}}"  
  rel="noopener noreferrer" class="btn btn-primary"> Pagar con TPV</a>

  @php
  $test = config('app.bizum_test');
  $bizum = 1;
  $value = $concept .  number_format($precio, 2, '.', ' ')  . "canariasexclusiva.com" . $anuncio->user->id . $anuncio->id . $plan->id . $option . $test . $bizum ;
  $firma = sha1($value . $encryptionPassphrase);
@endphp
<a href="https://www.ideascanarias.com/tpv.php?concept={{$concept}}&amount={{ number_format($precio, 2, '.', ' ') }}&fromDomain=canariasexclusiva.com&userId={{$anuncio->user->id}}&adId={{$anuncio->id}}&planId={{$plan->id}}&optionDescription={{$option}}&test={{$test}}&bizum={{$bizum}}&signature={{$firma}}"  
  rel="noopener noreferrer" class="btn btn-primary"> Pagar con Bizum</a>