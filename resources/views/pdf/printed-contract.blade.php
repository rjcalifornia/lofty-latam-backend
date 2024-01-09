<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Printed lease contract</title>
</head>

<body>
<div style="text-align:center;"><b>CONTRATO DE ARRENDAMIENTO RESIDENCIAL</b></div>
<span style="text-align:justify;">
<p>
Este Contrato de Arrendamiento ("Contrato") se celebra el [Fecha de Inicio], 
entre <b>{{Str::upper($lease->propertyId->landlordId->name)}} {{Str::upper($lease->propertyId->landlordId->lastname)}}</b>
portador del Documento Único de Identidad número:<b>{{$landlordDocument}}</b>; 
quien en el transcurso de este Documento se denominará "El Arrendante" , 
Y <b>{{Str::upper($lease->tenantId->name)}} {{Str::upper($lease->tenantId->lastname)}}</b> con Documento Único de 
Identidad número:<b>{{$tenantDocument}}</b>; que en lo sucesivo se denominará "Arrendatario". Por medio del siguiente documento
se otorga:
</p>
<br>
<b>PRIMERO:</b> El Arrendante acuerda arrendar y el Arrendatario acuerda tomar en arrendamiento la 
propiedad ubicada en <b>{{$lease->propertyId->address}}</b> ("Propiedad"). La Propiedad Arrendada cuenta con las siguientes amenidades:
El cual se regirá por las estipulaciones que se detallan en las caúsales siguientes: 
<br>
<b>SEGUNDO:</b> Que el Arrendante da y entrega en
arrendamiento  una casa en perfectas condiciones, y que el arrendatario la recibe a su entera satisfacción bajo las condiciones
siuientes: 
<br>
<b>TERCERO: PLAZO:</b> El plazo del Arrendamiento será por <b>{{Str::upper($lease->rentType->name)}}</b> prorrogables, contados 
a partir del {{$lease->human_readable_contract_date}}, y terminando el día {{$lease->human_readable_expiration_date}}, plazo 
que será prorrogable según lo convengan las partes.
.  
<br>
<b>CUARTO: PRECIO:</b> El Valor del Arrendamiento será de <b>{{Str::upper($totalRentPrice)}} DÓLARES DE 
LOS ESTADOS UNIDOS DE AMÉRICA EXACTOS</b>, suma que será pagada en seis cuotas mensuales fijas y 
sucesivas de: <b>{{Str::upper($rentPrice)}} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA</b> cada una, por mensualidades
pagadas el día <b>{{$lease->payment_day}} de cada uno de los meses comprendidos en el plazo, si se demora tres días
después de la fecha de pago deberá cancelar veinticinco dólares adicionales;</b> además tendrá que dar 
un deposito igual al pago de un mes de canon del arrendamiento que se le devolverá al final del contrato siempre y cuando 
no hubieran daños que reparar ni facturas pendientes además que este cumplido el contrato. En caso de continuar el arrendamiento bajo
un nuevo contrato, el depósito dado en el contrato anterior se retendrá hasta que caduque el nuevo contrato. 
<br>
<b>QUINTO: MORA EN EL PAGO:</b> la falta de pago de una sola mensualidad en la forma convenida, se dará por caducado el
presente contrato y la desocupación del inmueble en la forma establecida en la ley de inquilinato, además tendrá que pagar el resto
de las mensualidades que faltases de dicho contrato;
<br>
<b>SEXTO: PAGO DE SERVICIOS:</b> Serán por cuenta de el arrendatario los pagos de la energía eléctrica y agua, que se consuma
en dicha casa, y los impuestos municipales y seguridad, mantenimiento, por cuenta de el arrendante. 
<br>
<b>SÉPTIMO: REPARACIONES, MEJORAS Y USO:</b> a) El arrendatario se obliga a mejorar la casa y a no dañarla previa autorización escrita
del arrendante y las mejoras que se hicieren en cualquier forma quedaran en beneficio del Inmueble sin que "el arrendante" tenga que
pagar su valor, así como también cualquier daño que hubiese en los muebles que contiene la casa deberá cancelar su respectivo valor, al
igual que deberá darle mantenimiento a los aires acondicionados cada cuatro meses. La contravención a cualquiera de las prohibiciones
producirá los mismos efectos que la mora. 

Firmado este [Fecha de Firma].
</span>
______________________________           ______________________________
[Nombre del Arrendador]                         [Nombre del Arrendatario]

[Firma del Arrendador]                               [Firma del Arrendatario]
    {{$lease->tenantId->name}}
</body>
</html>