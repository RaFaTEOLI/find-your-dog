<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cachorros Perdidos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card col-lg-12">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="display: flex; justify-content: flex-end;">
                            <a type="button" href="{{ route('lost-dogs.new') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="active tab-pane" id="activity">
                            @foreach ($lostDogs as $lostDog)
                            <!-- Post -->
                            <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{ $lostDog->posted_by->profile_photo_url }}" alt="User Image">
                                <span class="username">
                                    <a href="#">{{ $lostDog->posted_by->name }}</a>
                                </span>
                                <span class="description">{{ date("d/m/Y H:i:s", strtotime($lostDog->created_at)) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-1">
                                <div class="col-lg-12">
                                    <pre style='font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";'>{{ $lostDog->description }}</pre>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    @foreach ($lostDog->dog_gallery as $photo)
                                        <a href="src={{ $photo->photo_url }}" target="_blank">
                                            <img class="img-fluid mb-2" style="width: 220px; height: 220px;" src={{ $photo->photo_url }} alt="Photo">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row mb-3">
                                <a href="#">Recompensa: R$ {{ $lostDog->reward }}</a>
                            </div>

                            <p>
                                {{-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Compartilhar</a> --}}
                                <a href="{{ route('lost-dogs.show', $lostDog->id) }}" class="link-black text-sm mr-2"><i class="fas fa-dog mr-1"></i> Encontrei</a>
                            </p>

                            <div class="d-flex">
                                @if (Auth::user()->hasRole("admin"))
                                <a type="button" href="{{ route('lost-dogs.show', $lostDog->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('lost-dogs.destroy', $lostDog->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                                @endif
                            </div>
                            </div>
                            <!-- /.post -->
                            @endforeach
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                    @if (count($lostDogs) < 1) <div style="text-align: center;">{{ __('Nenhum registro encontrado') }}</div> @endif
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>

</x-app-layout>
