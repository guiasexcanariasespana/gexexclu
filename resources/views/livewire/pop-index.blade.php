<div>
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div data-theme="light"
            class="inline-block  h-36 rounded-lg text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <div class="">
               <p class="text-lg font-extrabold my-5"> Selecciona una Provincia</p>
                <div class=" ">

                    <div class="my-1 inline-block"><a
                            href="{{ route('index_provincia', [$prov_tenerife]) }}"
                            class="text-gray-900  py-1 px-1  bg-base-200 hover:text-white hover:bg-black">{{ $prov_tenerife->nombre }}
                        </a>

                    </div>
                    <div class="my-1 inline-block"> <a
                            href="{{ route('index_provincia', [$prov_laspalmas]) }}"
                            class="text-gray-900  py-1 px-1  bg-base-200 hover:text-white hover:bg-black">{{ $prov_laspalmas->nombre }}

                        </a>
                    </div>

                </div>
         </div>
        </div>

    </div>
</div>
</div>
