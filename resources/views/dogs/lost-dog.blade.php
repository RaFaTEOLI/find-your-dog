<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cachorro Perdido') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box card shadow-sm" style="padding: 10px;">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right" style="display: flex; justify-content: flex-end;">
                    <a type="button" href="{{ route('lost-dogs') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-arrow-left"></i></a>
                </div>

                @if (!empty($lostDog->dog_gallery))
                <div class="row mt-2">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h4 class="card-title">Fotos do Cachorro</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                              @foreach ($lostDog->dog_gallery as $photo)
                                <div class="col-sm-2">
                                    <a href="{{ $photo->photo_url }}" target="_blank" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="{{ $photo->photo_url }}" class="img-fluid mb-2" alt="white sample">
                                    </a>
                                </div>
                              @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endif

                <input hidden id="current-user-id" value="{{ auth()->user()->id }}">
                <form enctype="multipart/form-data" role="form" action="{{ empty($lostDog) ? route('lost-dogs') : route('lost-dogs.update', $lostDog->id ?? '') }}" method="POST">
                    @csrf
                    @method(empty($lostDog) ? 'POST' : 'PUT')
                    @if (Auth::user()->hasRole("admin") || empty($lostDog) ? true : (Auth::user()->id == $lostDog->posted_by->id))
                    <div class="form-group">
                        <label>{{ __('Nome') }}</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{ $lostDog->name ?? '' }}">
                        @if ($errors->get('name'))
                        <p class="label-error">
                            @foreach ($errors->get('name') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('Descrição') }}</label>
                        <textarea id="description" type="text" name="description" class="form-control">{{ $lostDog->description ?? 'Informações sobre o cachorro.
Recompensa:  R$ 500,00' }}</textarea>
                        @if ($errors->get('description'))
                        <p class="label-error">
                            @foreach ($errors->get('description') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="photos[]" id="photos" multiple accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Visto pela última vez em') }}</label>
                        <input type="text" name="last_seen_at" class="form-control" value="{{ $lostDog->last_seen_at ?? '' }}">
                        @if ($errors->get('photos'))
                        <p class="label-error">
                            @foreach ($errors->get('photos') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    @endif
                    @if (!empty($lostDog))
                        <div class="form-group">
                            <label>{{ __('Encontrado por') }}</label>
                            <select disabled class="form-control" name="found_by" id="found_by">
                                <option value="">Ninguém</option>
                                @foreach ($users as $user)
                                    @if (!empty($lostDog->found_by))
                                        @if ($lostDog->found_by->id == $user->id)
                                            <option value="{{ $user->id }}" selected>{{ $user->name . " - " .  $user->email }}</option>
                                        @endif
                                    @endif
                                    <option value="{{ $user->id }}">{{ $user->name . " - " .  $user->email }}</option>
                                @endforeach
                            </select>
                            @if ($errors->get('found_by'))
                            <p class="label-error">
                                @foreach ($errors->get('found_by') as $error)

                                <strong>{{ $error }}</strong>

                                @endforeach
                            </p>
                            @endif
                        </div>

                        @if (!$lostDog->found_by)
                            <div class="form-group">
                                <button type="button" onclick="findDog()" class="btn btn-primary">{{ __('Encontrei o cachorro!') }}</button>
                            </div>

                            <div class="form-group" id="location-found" style="display: none;">
                                <label>{{ __('Local encontrado') }}</label>
                                <input disabled id="found_at" type="text" name="found_at" class="form-control" value="{{ $lostDog->found_at ?? '' }}">
                            </div>
                        @endif
                    @else
                        <input hidden name="posted_by" value="{{ auth()->user()->id }}">
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __('Salvar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const findDog = () => {
            $("#location-found").show();
            $("#found_by").val($("#current-user-id").val());
            $("#found_by").change();
            $("#found_by").attr("disabled", false);
            $("#found_at").attr("disabled", false);
            $("#found_by").attr("readonly", true);
        }
    </script>
</x-app-layout>
