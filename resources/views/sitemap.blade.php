<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>
            {{ url('/') }}
        </loc>
        <lastmod>{{ Carbon\Carbon::now()->startOfMonth()->format('c') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>
            {{ url('/') }}/privacy-policy
        </loc>
        <lastmod>{{ Carbon\Carbon::now()->startOfMonth()->format('c') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    
    <url>
        <loc>
            {{ url('/') }}/cookies-policy
        </loc>
        <lastmod>{{ Carbon\Carbon::now()->startOfMonth()->format('c') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>
            {{ url('/') }}/terms-of-service
        </loc>
        <lastmod>{{ Carbon\Carbon::now()->startOfMonth()->format('c') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
     <url>
        <loc>
            {{ url('/') }}/contact
        </loc>
        <lastmod>{{ Carbon\Carbon::now()->startOfMonth()->format('c') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>
            {{ url('/') }}/aviso_legal
        </loc>
        <lastmod>{{ Carbon\Carbon::now()->startOfMonth()->format('c') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>   
        @foreach ($provincias as $provincia)
            <url>
                <loc>
                    {{ url('/') }}/escort/{{ $provincia->slug }}
                </loc>
                <lastmod>{{ Carbon\Carbon::now()->startOfDay()->format('c') }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
            @foreach ($categorias as $cat)
            <url>
                <loc>
                    {{ url('/') }}/escort/{{ $provincia->slug }}/todos/{{ $cat->slug }}
                </loc>
                <lastmod>{{ Carbon\Carbon::now()->startOfDay()->format('c') }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
            
        @endforeach
            @foreach ($provincia->municipios as $muni)
            <url>
                <loc>
                    {{ url('/') }}/escort/{{ $provincia->slug }}/{{ $muni->slug }}
                </loc>
                <lastmod>{{ Carbon\Carbon::now()->startOfDay()->format('c') }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
            @foreach ($categorias as $cat)
            <url>
                <loc>
                    {{ url('/') }}/escort/{{ $provincia->slug }}/{{ $muni->slug }}/{{ $cat->slug }}
                </loc>
                <lastmod>{{ Carbon\Carbon::now()->startOfDay()->format('c') }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
            
        @endforeach
        @endforeach
        @endforeach

    @foreach ($anuncios as $anun)
        <url>
            <loc>
                {{ url('/') }}/escort/{{ $anun->provincia->slug }}/{{ $anun->municipio->slug }}/{{ $anun->categoria->slug }}/{{ $anun->user_id }}/{{ $anun->slug }}
            </loc>
            @foreach ($anun->imagenes_verificadas_ordenadas as $img)
                <image:image>
                    <image:loc>{{ url('/') }}/images/anuncio/{{ $anun->id }}/{{ $img->nombre }}</image:loc>
                </image:image>
            @endforeach
            <lastmod>{{ $anun->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
