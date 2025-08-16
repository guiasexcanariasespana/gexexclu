<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'whatsapp',
        'fecha_de_nacimiento',
        'codigo_ws',
        'paso',
        'estado_wsp',
        'verificado',
        'imagen_verificacion',
        'nacionalidad',
        'profesion',
        'direccion',
        'direccion_a_mostrar',
        'gps',
        'edad',
        'email_verified_at'

    ];


    static $rules = [
        'name' => 'required',
        'email' => 'required',
        'estado_wsp' => 'required',
        'edad' => 'required|numeric|gt:17',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [        
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    // public $paises = [""=>" ", "ESP" => "España", "AFG" => "Afganistán", "ALB" => "Albania", "DEU" => "Alemania", "AND" => "Andorra", "AGO" => "Angola", "ATG" => "Antigua y Barbuda", "SAU" => "Arabia Saudita", "DZA" => "Argelia", "ARG" => "Argentina", "ARM" => "Armenia", "AUS" => "Australia", "AUT" => "Austria", "AZE" => "Azerbaiyán", "BHS" => "Bahamas", "BGD" => "Bangladés", "BRB" => "Barbados", "BHR" => "Baréin", "BEL" => "Bélgica", "BLZ" => "Belice", "BEN" => "Benín", "BLR" => "Bielorrusia", "MMR" => "Birmania", "BOL" => "Bolivia", "BIH" => "Bosnia y Herzegovina", "BWA" => "Botsuana", "BRA" => "Brasil", "BRN" => "Brunéi", "BGR" => "Bulgaria", "BFA" => "Burkina Faso", "BDI" => "Burundi", "BTN" => "Bután", "CPV" => "Cabo Verde", "KHM" => "Camboya", "CMR" => "Camerún", "CAN" => "Canadá", "QAT" => "Catar", "TCD" => "Chad", "CHL" => "Chile", "CHN" => "China", "CYP" => "Chipre", "VAT" => "Ciudad del Vaticano", "COL" => "Colombia", "COM" => "Comoras", "PRK" => "Corea del Norte", "KOR" => "Corea del Sur", "CIV" => "Costa de Marfil", "CRI" => "Costa Rica", "HRV" => "Croacia", "CUB" => "Cuba", "DNK" => "Dinamarca", "DMA" => "Dominica", "ECU" => "Ecuador", "EGY" => "Egipto", "SLV" => "El Salvador", "ARE" => "Emiratos Árabes Unidos", "ERI" => "Eritrea", "SVK" => "Eslovaquia", "SVN" => "Eslovenia",  "USA" => "Estados Unidos", "EST" => "Estonia", "ETH" => "Etiopía", "PHL" => "Filipinas", "FIN" => "Finlandia", "FJI" => "Fiyi", "FRA" => "Francia", "GAB" => "Gabón", "GMB" => "Gambia", "GEO" => "Georgia", "GHA" => "Ghana", "GRD" => "Granada", "GRC" => "Grecia", "GTM" => "Guatemala", "GUY" => "Guyana", "GIN" => "Guinea", "GNQ" => "Guinea Ecuatorial", "GNB" => "Guinea-Bisáu", "HTI" => "Haití", "HND" => "Honduras", "HUN" => "Hungría", "IND" => "India", "IDN" => "Indonesia", "IRQ" => "Irak", "IRN" => "Irán", "IRL" => "Irlanda", "ISL" => "Islandia", "MHL" => "Islas Marshall", "SLB" => "Islas Salomón", "ISR" => "Israel", "ITA" => "Italia", "JAM" => "Jamaica", "JPN" => "Japón", "JOR" => "Jordania", "KAZ" => "Kazajistán", "KEN" => "Kenia", "KGZ" => "Kirguistán", "KIR" => "Kiribati", "KWT" => "Kuwait", "LAO" => "Laos", "LSO" => "Lesoto", "LVA" => "Letonia", "LBN" => "Líbano", "LBR" => "Liberia", "LBY" => "Libia", "LIE" => "Liechtenstein", "LTU" => "Lituania", "LUX" => "Luxemburgo", "MDG" => "Madagascar", "MYS" => "Malasia", "MWI" => "Malaui", "MDV" => "Maldivas", "MLI" => "Malí", "MLT" => "Malta", "MAR" => "Marruecos", "MUS" => "Mauricio", "MRT" => "Mauritania", "MEX" => "México", "FSM" => "Micronesia", "MDA" => "Moldavia", "MCO" => "Mónaco", "MNG" => "Mongolia", "MNE" => "Montenegro", "MOZ" => "Mozambique", "NAM" => "Namibia", "NRU" => "Nauru", "NPL" => "Nepal", "NIC" => "Nicaragua", "NER" => "Níger", "NGA" => "Nigeria", "NOR" => "Noruega", "NZL" => "Nueva Zelanda", "OMN" => "Omán", "NLD" => "Países Bajos", "PAK" => "Pakistán", "PLW" => "Palaos", "PSE" => "Palestina", "PAN" => "Panamá", "PNG" => "Papúa Nueva Guinea", "PRY" => "Paraguay", "PER" => "Perú", "POL" => "Polonia", "PRT" => "Portugal", "GBR" => "Reino Unido", "CAF" => "República Centroafricana", "CZE" => "República Checa", "MKD" => "República de Macedonia", "COG" => "República del Congo", "COD" => "República Democrática del Congo", "DOM" => "República Dominicana", "ZAF" => "República Sudafricana", "RWA" => "Ruanda", "ROU" => "Rumanía", "RUS" => "Rusia", "WSM" => "Samoa", "KNA" => "San Cristóbal y Nieves", "SMR" => "San Marino", "VCT" => "San Vicente y las Granadinas", "LCA" => "Santa Lucía", "STP" => "Santo Tomé y Príncipe", "SEN" => "Senegal", "SRB" => "Serbia", "SYC" => "Seychelles", "SLE" => "Sierra Leona", "SGP" => "Singapur", "SYR" => "Siria", "SOM" => "Somalia", "LKA" => "Sri Lanka", "SWZ" => "Suazilandia", "SDN" => "Sudán", "SSD" => "Sudán del Sur", "SWE" => "Suecia", "CHE" => "Suiza", "SUR" => "Surinam", "THA" => "Tailandia", "TZA" => "Tanzania", "TJK" => "Tayikistán", "TLS" => "Timor Oriental", "TGO" => "Togo", "TON" => "Tonga", "TTO" => "Trinidad y Tobago", "TUN" => "Túnez", "TKM" => "Turkmenistán", "TUR" => "Turquía", "TUV" => "Tuvalu", "UKR" => "Ucrania", "UGA" => "Uganda", "URY" => "Uruguay", "UZB" => "Uzbekistán", "VUT" => "Vanuatu", "VEN" => "Venezuela", "VNM" => "Vietnam", "YEM" => "Yemen", "DJI" => "Yibuti", "ZMB" => "Zambia", "ZWE" => "Zimbabue"];
    public $paises = array("", "España", "Latina", "Afganistán","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Arabia Saudita","Argelia","Argentina","Armenia","Australia","Austria","Azerbaiyán","Bahamas","Bangladés","Barbados","Baréin","Bélgica","Belice","Benín","Bielorrusia","Birmania","Bolivia","Bosnia y Herzegovina","Botsuana","Brasil","Brunéi","Bulgaria","Burkina Faso","Burundi","Bután","Cabo Verde","Camboya","Camerún","Canadá","Catar","Chad","Chile","China","Chipre","Ciudad del Vaticano","Colombia","Comoras","Corea del Norte","Corea del Sur","Costa de Marfil","Costa Rica","Croacia","Cuba","Dinamarca","Dominica","Ecuador","Egipto","El Salvador","Emiratos Árabes Unidos","Eritrea","Eslovaquia","Eslovenia","Estados Unidos","Estonia","Etiopía","Filipinas","Finlandia","Fiyi","Francia","Gabón","Gambia","Georgia","Ghana","Granada","Grecia","Guatemala","Guyana","Guinea","Guinea ecuatorial","Guinea-Bisáu","Haití","Honduras","Hungría","India","Indonesia","Irak","Irán","Irlanda","Islandia","Islas Marshall","Islas Salomón","Israel","Italia","Jamaica","Japón","Jordania","Kazajistán","Kenia","Kirguistán","Kiribati","Kuwait","Laos","Lesoto","Letonia","Líbano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Madagascar","Malasia","Malaui","Maldivas","Malí","Malta","Marruecos","Mauricio","Mauritania","México","Micronesia","Moldavia","Mónaco","Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal","Nicaragua","Níger","Nigeria","Noruega","Nueva Zelanda","Omán","Países Bajos","Pakistán","Palaos","Palestina","Panamá","Papúa Nueva Guinea","Paraguay","Perú","Polonia","Portugal","Reino Unido","República Centroafricana","República Checa","República de Macedonia","República del Congo","República Democrática del Congo","República Dominicana","República Sudafricana","Ruanda","Rumanía","Rusia","Samoa","San Cristóbal y Nieves","San Marino","San Vicente y las Granadinas","Santa Lucía","Santo Tomé y Príncipe","Senegal","Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka","Suazilandia","Sudán","Sudán del Sur","Suecia","Suiza","Surinam","Tailandia","Tanzania","Tayikistán","Timor Oriental","Togo","Tonga","Trinidad y Tobago","Túnez","Turkmenistán","Turquía","Tuvalu","Ucrania","Uganda","Uruguay","Uzbekistán","Vanuatu","Venezuela","Vietnam","Yemen","Yibuti","Zambia","Zimbabue");

    // public $paises = [""=>" ", "ESP" => "España", "AFG" => "Afganistán", "ALB" => "Albania", "DEU" => "Alemania", "AND" => "Andorra", "AGO" => "Angola", "ATG" => "Antigua y Barbuda", "SAU" => "Arabia Saudita", "DZA" => "Argelia", "ARG" => "Argentina", "ARM" => "Armenia", "AUS" => "Australia", "AUT" => "Austria", "AZE" => "Azerbaiyán", "BHS" => "Bahamas", "BGD" => "Bangladés", "BRB" => "Barbados", "BHR" => "Baréin", "BEL" => "Bélgica", "BLZ" => "Belice", "BEN" => "Benín", "BLR" => "Bielorrusia", "MMR" => "Birmania", "BOL" => "Bolivia", "BIH" => "Bosnia y Herzegovina", "BWA" => "Botsuana", "BRA" => "Brasil", "BRN" => "Brunéi", "BGR" => "Bulgaria", "BFA" => "Burkina Faso", "BDI" => "Burundi", "BTN" => "Bután", "CPV" => "Cabo Verde", "KHM" => "Camboya", "CMR" => "Camerún", "CAN" => "Canadá", "QAT" => "Catar", "TCD" => "Chad", "CHL" => "Chile", "CHN" => "China", "CYP" => "Chipre", "VAT" => "Ciudad del Vaticano", "COL" => "Colombia", "COM" => "Comoras", "PRK" => "Corea del Norte", "KOR" => "Corea del Sur", "CIV" => "Costa de Marfil", "CRI" => "Costa Rica", "HRV" => "Croacia", "CUB" => "Cuba", "DNK" => "Dinamarca", "DMA" => "Dominica", "ECU" => "Ecuador", "EGY" => "Egipto", "SLV" => "El Salvador", "ARE" => "Emiratos Árabes Unidos", "ERI" => "Eritrea", "SVK" => "Eslovaquia", "SVN" => "Eslovenia",  "USA" => "Estados Unidos", "EST" => "Estonia", "ETH" => "Etiopía", "PHL" => "Filipinas", "FIN" => "Finlandia", "FJI" => "Fiyi", "FRA" => "Francia", "GAB" => "Gabón", "GMB" => "Gambia", "GEO" => "Georgia", "GHA" => "Ghana", "GRD" => "Granada", "GRC" => "Grecia", "GTM" => "Guatemala", "GUY" => "Guyana", "GIN" => "Guinea", "GNQ" => "Guinea Ecuatorial", "GNB" => "Guinea-Bisáu", "HTI" => "Haití", "HND" => "Honduras", "HUN" => "Hungría", "IND" => "India", "IDN" => "Indonesia", "IRQ" => "Irak", "IRN" => "Irán", "IRL" => "Irlanda", "ISL" => "Islandia", "MHL" => "Islas Marshall", "SLB" => "Islas Salomón", "ISR" => "Israel", "ITA" => "Italia", "JAM" => "Jamaica", "JPN" => "Japón", "JOR" => "Jordania", "KAZ" => "Kazajistán", "KEN" => "Kenia", "KGZ" => "Kirguistán", "KIR" => "Kiribati", "KWT" => "Kuwait", "LAO" => "Laos", "LSO" => "Lesoto", "LVA" => "Letonia", "LBN" => "Líbano", "LBR" => "Liberia", "LBY" => "Libia", "LIE" => "Liechtenstein", "LTU" => "Lituania", "LUX" => "Luxemburgo", "MDG" => "Madagascar", "MYS" => "Malasia", "MWI" => "Malaui", "MDV" => "Maldivas", "MLI" => "Malí", "MLT" => "Malta", "MAR" => "Marruecos", "MUS" => "Mauricio", "MRT" => "Mauritania", "MEX" => "México", "FSM" => "Micronesia", "MDA" => "Moldavia", "MCO" => "Mónaco", "MNG" => "Mongolia", "MNE" => "Montenegro", "MOZ" => "Mozambique", "NAM" => "Namibia", "NRU" => "Nauru", "NPL" => "Nepal", "NIC" => "Nicaragua", "NER" => "Níger", "NGA" => "Nigeria", "NOR" => "Noruega", "NZL" => "Nueva Zelanda", "OMN" => "Omán", "NLD" => "Países Bajos", "PAK" => "Pakistán", "PLW" => "Palaos", "PSE" => "Palestina", "PAN" => "Panamá", "PNG" => "Papúa Nueva Guinea", "PRY" => "Paraguay", "PER" => "Perú", "POL" => "Polonia", "PRT" => "Portugal", "GBR" => "Reino Unido", "CAF" => "República Centroafricana", "CZE" => "República Checa", "MKD" => "República de Macedonia", "COG" => "República del Congo", "COD" => "República Democrática del Congo", "DOM" => "República Dominicana", "ZAF" => "República Sudafricana", "RWA" => "Ruanda", "ROU" => "Rumanía", "RUS" => "Rusia", "WSM" => "Samoa", "KNA" => "San Cristóbal y Nieves", "SMR" => "San Marino", "VCT" => "San Vicente y las Granadinas", "LCA" => "Santa Lucía", "STP" => "Santo Tomé y Príncipe", "SEN" => "Senegal", "SRB" => "Serbia", "SYC" => "Seychelles", "SLE" => "Sierra Leona", "SGP" => "Singapur", "SYR" => "Siria", "SOM" => "Somalia", "LKA" => "Sri Lanka", "SWZ" => "Suazilandia", "SDN" => "Sudán", "SSD" => "Sudán del Sur", "SWE" => "Suecia", "CHE" => "Suiza", "SUR" => "Surinam", "THA" => "Tailandia", "TZA" => "Tanzania", "TJK" => "Tayikistán", "TLS" => "Timor Oriental", "TGO" => "Togo", "TON" => "Tonga", "TTO" => "Trinidad y Tobago", "TUN" => "Túnez", "TKM" => "Turkmenistán", "TUR" => "Turquía", "TUV" => "Tuvalu", "UKR" => "Ucrania", "UGA" => "Uganda", "URY" => "Uruguay", "UZB" => "Uzbekistán", "VUT" => "Vanuatu", "VEN" => "Venezuela", "VNM" => "Vietnam", "YEM" => "Yemen", "DJI" => "Yibuti", "ZMB" => "Zambia", "ZWE" => "Zimbabue"];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }


    public function zone(){
        return $this->belongsTo(Zone::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

     public function anuncios_activos(){
        // anuncio en borrador, publicado o pausado
       $anuncios= $this->anuncios()->whereIn('estado', ['Borrador', 'Publicado', 'Pausado', 'Suspendido', 'A_Publicar'])->get();
       return $anuncios;
     }

     public function puede_comprar(){
         return (count($this->anuncios_activos()) == 0);
     }

     public function hasVerifiedPhone(){
         return $this->estado_wsp == 'Validado';
     }
    
     public function isVerificado(){
        return $this->verificado == 'Si';
     }


    public function compro_primero()
    {
        $tiene_pimer_anuncio = $this->anuncios()->whereIn('estado', ['Borrador', 'A_Publicar', 'Publicado', 'Suspendido', 'Finalizado'])->get();
       return (count($tiene_pimer_anuncio) > 0);
    }

    public function anuncio_inicial()
    {
        $pimer_anuncio = $this->anuncios()->whereNull('nombre')->where('estado', 'Borrador')->where('estado_pago', 'Si')->first();
        return $pimer_anuncio;
    }
}
