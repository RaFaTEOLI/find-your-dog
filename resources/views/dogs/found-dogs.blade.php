<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cachorros') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card col-lg-12">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            @foreach ($foundDogs as $foundDog)
                            <!-- Post -->
                            <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{ $foundDog->posted_by->profile_photo_url }}" alt="User Image">
                                <span class="username">
                                    <a href="#">{{ $foundDog->posted_by->name }}</a>
                                </span>
                                <span class="description">{{ date("d/m/Y H:i:s", strtotime($foundDog->created_at)) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-1">
                                <div class="col-lg-12">
                                    <pre style='font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";'>{{ $foundDog->description }}</pre>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    @foreach ($foundDog->dog_gallery as $photo)
                                        <a href="src={{ $photo->photo_url }}" target="_blank">
                                            <img class="img-fluid mb-2" style="width: 220px; height: 220px;" src={{ $photo->photo_url }} alt="Photo">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row mb-3">
                                <a href="#">Recompensa: R$ {{ $foundDog->reward }}</a>
                            </div>

                            <p>
                                <a href="{{ route('found-dogs.show', $foundDog->id) }}" class="link-black text-sm mr-2"><i class="fas fa-eye mr-1"></i> Abrir</a>
                            </p>

                            <div class="d-flex">
                                @if (Auth::user()->hasRole("admin"))
                                <a type="button" href="{{ route('found-dogs.show', $foundDog->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('found-dogs.destroy', $foundDog->id) }}" method="post">
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
                    @if (count($foundDogs) < 1) <div style="text-align: center;">{{ __('Nenhum registro encontrado') }}</div> @endif
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>

</x-app-layout>
