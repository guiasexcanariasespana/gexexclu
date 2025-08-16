<div id="banderas">
    <!-- GTranslate: https://gtranslate.net/ -->
    <div id="main" class="flex flex-wrap content-start">

        <a href="#" onclick="doGTranslate('es|zh-TW');return false;" title="Chinese (Traditional)" class="gflag nturl"
            style="background-position:-400px -0px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de China.svg" height="25" width="25"
                alt="Chinese (Traditional)" /></a>
        <a href="#" onclick="doGTranslate('es|fr');return false;" title="French" class="gflag nturl"
            style="background-position:-200px -100px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de Francia.svg" height="25" width="25"
                alt="French" /></a>
        <a href="#" onclick="doGTranslate('es|de');return false;" title="German" class="gflag nturl"
            style="background-position:-300px -100px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de Alemania.svg" height="25"
                width="25" alt="German" /></a>
        <a href="#" onclick="doGTranslate('es|it');return false;" title="Italian" class="gflag nturl"
            style="background-position:-600px -100px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de Italia.svg" height="25" width="25"
                alt="Italian" /></a>
        <a href="#" onclick="doGTranslate('es|pt');return false;" title="Portuguese" class="gflag nturl"
            style="background-position:-300px -200px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de Portugal.svg" height="25"
                width="25" alt="Portuguese" /></a>
        <a href="#" onclick="doGTranslate('es|ru');return false;" title="Russian" class="gflag nturl"
            style="background-position:-500px -200px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de Rusia.svg" height="25" width="25"
                alt="Russian" /></a>
        <a href="#" onclick="doGTranslate('es|es');return false;" title="Spanish" class="gflag nturl"
            style="background-position:-600px -200px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Bandera de España.svg" height="25" width="25"
                alt="Spanish" /></a>
        <a href="#" onclick="doGTranslate('es|ca');return false;" title="Catalan" class="gflag nturl"
            style="background-position:-300px -200px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/Catalonia.svg" height="25" width="25"
                alt="Catalan" /></a>
        <a href="#" onclick="doGTranslate('es|eu');return false;" title="Basque" class="gflag nturl"
            style="background-position:-300px -200px;"><img
                src="{{ config('app.asset_prefix') }}/img/banderas/basco.svg" height="25" width="25"
                alt="Basque" /></a>

    </div>


    <style type="text/css">
        <!--
        a.gflag {
            vertical-align: middle;
            font-size: 16px;
            padding: 5px 6px;
            background-repeat: no-repeat;
            /* background-image: url('/template/formato_guiasexcanarias/modulos/mod_gtranslate/tmpl/lang/24.png'); */
        }

        a.gflag img {
            border: 0;
        }

        a.gflag:hover {
            /* background-image: url('/template/formato_guiasexcanarias/modulos/mod_gtranslate/tmpl/lang/24a.png'); */
            -webkit-filter: grayscale(1);
            filter: grayscale(1);
        }

        #goog-gt-tt {
            display: none !important;
        }

        .goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-menu-value:hover {
            text-decoration: none !important;
        }

        body {
            top: 0 !important;
        }

        #google_translate_element2 {
            display: none !important;
        }
        -->
    </style>

    <div id="google_translate_element2"></div>
    <script type="text/javascript">
        function googleTranslateElementInit2() {
            new google.translate.TranslateElement({
                pageLanguage: 'es',
                autoDisplay: false
            }, 'google_translate_element2');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2">
    </script>


    <script type="text/javascript">
        /* <![CDATA[ */
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c
                    .toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',
            43, 43,
            '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'
            .split('|'), 0, {}))
        /* ]]> */
    </script>
    <script>
        $(function() {
            $('#gtidiomas').on('change', function() {
                lang = $(this).val();
                doGTranslate(lang);
                return false;
            })
        });
    </script>
    <!--<script type="text/javascript" src="https://joomla-gtranslate.googlecode.com/svn/trunk/gt_update_notes0.js"></script>-->
</div>
