@extends('layouts.master')
@section('content')
    @if(empty($laPresentation))
        <h1>Ajout d'une Formulation pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => '/ajouterLaFormulation')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <label>Présentation</label>
        <select name="id_presentation">
            @foreach($mesPresentation as $ligne)
                <?php $disabled = ''?>
                @foreach($mesFormulations as $formule)
                    @if(($ligne->id_presentation) == ($formule->id_presentation))
                        <?php $disabled = ' disabled '?>
                    @endif
                @endforeach
                <option value="{{$ligne->id_presentation}}" <?php echo $disabled?>>{{$ligne->lib_presentation}}</option>
            @endforeach
        </select>
        <label>Quantité Formuler</label>
        <input type="number" name="qte_formuler">
        <button type="submit">Ajouter</button>
        {{ Form::close() }}
    @else
        <h1>Modification d'une Formulation pour le médicament : {{$mesFormulations[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => '/updateLaFormulation')) }}
        <input type="hidden" value="{{$mesFormulations[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$mesFormulations[0]->id_presentation}}" name="oldprensetation">
        <label>Présentation</label>
        <select name="id_presentation">
            @foreach($mesPresentation as $ligne)
                <?php $disabled = ''?>
                <?php $selected = ''?>
                @if(($ligne->id_presentation) == ($laPresentation[0]->id_presentation) )
                    <?php $selected = ' selected '?>
                @endif
                @foreach($mesFormulations as $formule)
                    @if(($ligne->id_presentation) == ($formule->id_presentation))
                        <?php $disabled = ' disabled '?>
                    @endif
                @endforeach
                <option value="{{$ligne->id_presentation}}" <?php echo $selected ?><?php echo $disabled?>>{{$ligne->lib_presentation}}</option>
            @endforeach
        </select>
        <label>Quantité Formuler</label>
        <input type="number" name="qte_formuler" value="{{$uneFormulation->qte_formuler}}">
        <button type="submit">Modifier</button>
        {{ Form::close() }}
    @endif

@stop

