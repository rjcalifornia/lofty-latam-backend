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
Este Contrato de Arrendamiento ("Contrato") entre <b>{{Str::upper($lease->propertyId->landlordId->name)}} {{Str::upper($lease->propertyId->landlordId->lastname)}}</b>
portador del Documento Único de Identidad número:<b>{{$landlordDocument}}</b>;  quien en el transcurso de este Documento se denominará "El Arrendante",
Y <b>{{Str::upper($lease->tenantId->name)}} {{Str::upper($lease->tenantId->lastname)}}</b> con Documento Único de 
Identidad número:<b>{{$tenantDocument}}</b>; que en lo sucesivo se denominará "Arrendatario". Por medio del siguiente documento
se otorga:
</p>
<br>
<b>PRIMERO:</b> El Arrendante acuerda arrendar y el Arrendatario acuerda tomar en arrendamiento la 
propiedad ubicada en <b>{{$lease->propertyId->address}}</b> ("Propiedad"). La Propiedad Arrendada cuenta con las siguientes amenidades:
{{$lease->propertyId->bedrooms}} cuarto(s),
{{$lease->propertyId->beds}} cama(s),
{{$lease->propertyId->bathrooms}} baño(s),
{{$lease->propertyId->has_ac ? 'aire acondicionado, ' : ''}}
{{$lease->propertyId->has_kitchen ? 'cocina, ' : ''}}
{{$lease->propertyId->has_dinning_room ? 'mesa de comedor, ' : ''}}
{{$lease->propertyId->has_sink ? 'lavatrastos, ' : ''}}
{{$lease->propertyId->has_wifi ? 'internet wifi, ' : ''}}
{{$lease->propertyId->has_fridge ? 'refrigeradora, ' : ''}}
{{$lease->propertyId->has_tv ? 'televisión, ' : ''}}
{{$lease->propertyId->has_furniture ? 'muebles de sala, ' : ''}}
{{$lease->propertyId->has_garage ? 'con espacio de cochera.' : 'sin espacio de cochera.'}}
El cual se regirá por las estipulaciones que se detallan en las caúsales siguientes: 
<br>
<b>SEGUNDO:</b> Que el Arrendante da y entrega en
arrendamiento  una casa en perfectas condiciones, y que el arrendatario la recibe a su entera satisfacción bajo las condiciones
siguientes: 
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
producirá los mismos efectos que la mora. Serán por cuenta del arrendante, las reparaciones locativas tales como: reparaciones de cualquier desperfecto
que no sea consecuencia del desgaste por uso natural del inmueble y las causadas por daños de fuerza mayor o
caso fortuito. b) Así mismo el arrendatario se compromete a entregar la casa en buen estado y en iguales condiciones
en que se encuentra. c) Que la casa que arriendo, debe ser única y exclusivamente para <b>VIVIENDA FAMILIAR</b>, se prohíbe
a la arrendataria subarrendar el inmueble total o parcialmente, o destinarlo a un fin distinto de lo convenido, y guardar
en la propiedad material como estupefacientes, inflamables, explosivos, humectantes, que constituyan peligro de
destrucción para el inmueble alquilado. 
<br>
<b>OCTAVO: TERMINACIÓN DE CONTRATO: </b>La terminación del contrato por cualquier causa que fuere, el arrendatario
se obliga a devolver el inmueble y las mejoras que se hicieren en cualquier forma que lo recibe con sus llaves
y con los últimos recibos de energía eléctrica y agua potable cancelados. Y todo en perfecto estado tal y
como se recibió.
<br>
<b>NOVENO: EFECTOS DEL CONTRATO.</b> los efectos legales de este contrato, nos sometemos al domicilio de los
tribunales de esta ciudad, y en caso de acción judicial, el arrendatario renuncia al derecho de apelar del
derecho de embargo, sentencia y remate de cualquier otra providencia apelable que se pronunciare en el juicio
que se promoviera a consecuencia de este contrato, siendo de sus cargos en que incurran el arrendante en el 
cobro de lo adeudado, inclusive los costas procesales aunque no fuere condenado en costas, y será depositario judicial,
la persona que el arrendante designe a quien relevan de la obligación de rendir fianza y cuentas. Así se expresaron los
comparecientes. En fe de lo anterior firmamos el presente documento.

</body>
</html>