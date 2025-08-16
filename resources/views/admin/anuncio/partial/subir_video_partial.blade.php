<div class="form-group bg-light">

                        <form method="POST" action="{{ route('admin.anuncios.guardar_video', $anuncio) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                
                                    <div class="col">
                                        <div class="image-wrapper">
                                            <video width="320" height="240" controls src=''>
                                               
                                            </video>
                                        </div>

                                    </div>
                                    <input class="form-control mx-auto mt-5" id="videoUpload" type="file" name="image"
                                        accept="video/*" onchange="previewImage();" />
                             
                                <br>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary bg-blue-600">{{ __('Submit') }}</button>
                                </div>
                        </form>
</div>                        