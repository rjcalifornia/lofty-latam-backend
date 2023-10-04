@extends('email.layouts.main')

@section('content')
<div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
  </div>
  <div style="max-width: 600px; margin: 0 auto;" class="email-container">

<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
    <tr>
    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td class="logo" style="text-align: center;">
                  <h1 class="heading1">Lofty Latam</h1>
                </td>
            </tr>
        </table>
    </td>
    </tr><!-- end tr -->
          <tr>
    <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
              <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
                  <div class="text">
                      <h2>Estimado usuario</h2>
                  </div>
              </td>
          </tr>
          <tr>
                <td style="text-align: center;">
                    <div class="text-author">
                        <img src="data:image/png;base64, {{$logo}}" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
                       
                        <span class="position">Te adjuntamos tu recibo digital de pago de alquiler a este correo.</span>
                        
                     </div>
                </td>
              </tr>
      </table>
    </td>
    </tr><!-- end tr -->
<!-- 1 Column Text + Button : END -->
</table>

@endsection