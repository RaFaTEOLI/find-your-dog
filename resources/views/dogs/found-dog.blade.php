<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cachorro Achado') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box card shadow-sm" style="padding: 10px;">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right" style="display: flex; justify-content: flex-end;">
                    <a type="button" href="{{ route('lost-dogs') }}" class="btn btn-success pull-right row b-none"><i class="fa fa-arrow-left"></i></a>
                </div>

                @if (!empty($foundDog->dog_gallery))
                <div class="row mt-2">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h4 class="card-title">Fotos do Cachorro</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                              @foreach ($foundDog->dog_gallery as $photo)
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

                @if (!empty($found->photo_found))
                <div class="row mt-2">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h4 class="card-title">Foto do Cachorro Encontrado</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-2">
                                <a href="{{ $found->photo_found }}" target="_blank" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                    <img src="{{ $found->photo_found }}" class="img-fluid mb-2" alt="white sample">
                                </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endif

                @if (!empty($found->photo_received))
                <div class="row mt-2">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h4 class="card-title">Foto do Cachorro Recebido</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-2">
                                <a href="{{ $found->photo_received }}" target="_blank" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                    <img src="{{ $found->photo_received }}" class="img-fluid mb-2" alt="white sample">
                                </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endif

                <input hidden id="current-user-id" value="{{ auth()->user()->id }}">
                <form id="form-dog" enctype="multipart/form-data" role="form" action="{{ empty($foundDog) ? route('found-dogs') : route('found-dogs.update', $foundDog->id ?? '') }}" method="POST">
                    @csrf
                    @method(empty($foundDog) ? 'POST' : 'PUT')
                    @if (Auth::user()->hasRole("admin") || empty($foundDog) ? true : (Auth::user()->id == $foundDog->posted_by->id))
                    <div class="form-group">
                        <label>{{ __('Nome') }}</label>
                        <input readonly id="name" type="text" name="name" class="form-control" value="{{ $foundDog->name ?? '' }}">
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
                        <textarea readonly id="description" type="text" name="description" class="form-control">{{ $foundDog->description ?? 'Informações sobre o cachorro.' }}</textarea>
                        @if ($errors->get('description'))
                        <p class="label-error">
                            @foreach ($errors->get('description') as $error)

                            <strong>{{ $error }}</strong>

                            @endforeach
                        </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col<?php (!$found->paid) ? "-6" : "-12" ?>">
                                <label>{{ __('Recompensa') }}</label>
                                <input id="reward" type="text" name="reward" class="form-control money" value="{{ $foundDog->reward ?? '' }}" style="text-align: left;" readonly>
                                @if ($errors->get('reward'))
                                <p class="label-error">
                                    @foreach ($errors->get('reward') as $error)

                                    <strong>{{ $error }}</strong>

                                    @endforeach
                                </p>
                                @endif
                            </div>
                            @if (!$found->paid)
                            <div class="col-6" style="display: inline-block; align-self: flex-end;">
                                <br />
                                <input hidden type="text" name="paid" id="paid" value="0" />
                                <button type="button" id="pay" class="btn btn-primary">{{ __('Pagar') }}</button>
                            </div>
                            @else
                            <div class="col-6" style="display: inline-block; align-self: flex-end;">
                                <?php
                                    $whatsappLink = $foundDog->found_by->phone ? "https://wa.me/" . $foundDog->found_by->phone : "#";
                                ?>
                                <a type="button" href="{{ $whatsappLink }}" target="_blank" class="btn btn-primary">Enviar Mensagem</a>
                            </div>
                            @endif
                        </div>
                    </div>
                        @if (Auth::user()->id == $foundDog->posted_by->id)
                        <div class="form-group">
                            <label>{{ __('Foto da entrega') }}</label>
                            <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                        </div>
                        @endif
                    @endif

                    @if (Auth::user()->id == $foundDog->posted_by->id)
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __('Salvar') }}</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = () => {
            const payButton = document.querySelector("#pay");
            payButton.onclick = () => {
                document.querySelector("#paid").value = 1;
                document.querySelector("#form-dog").submit();
            }
        }
    </script>
</x-app-layout>
