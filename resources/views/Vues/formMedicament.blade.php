@extends('layouts.master')
@section('content')
    <div class="input_container">
        <h1>choisissez votre médicament : </h1>
        <input class="awsome_input" id='myInput' onkeyup='searchTable()' type='text'
               placeholder="Recherche d'un médicament">
        <span class="awsome_input_border"/>
    </div>
    <br>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
        <tr id='tableHeader'>
            <th>id famille</th>
            <th>depot légal</th>
            <th>nom commercial</th>
            <th>effets</th>
            <th>contre indication</th>
            <th>prix echantillons</th>
            <th>Autre</th>
        </tr>
        </thead>
        <?php $i = 0; $class = '';?>
        @foreach($mesMedicament as $unMedicament)
            <?php
            $i++;
            $r = fmod($i, 2);
            ?>
            <?php echo "<tr " . (($r == 0) ? "class='couleur'" : "") . " '>";?>
            <td class="search"> {{ $unMedicament->lib_famille}} </td>
            <td> {{ $unMedicament->depot_legal }}</td>
            <td class="search">{{ $unMedicament->nom_commercial }}</td>
            <td>{{$unMedicament->effets}}</td>
            <td> {{ $unMedicament->contre_indication }} </td>
            <td> {{ $unMedicament->prix_echantillon }} </td>
            <td><a href="{{ url('/listerFormule') }}/{{  $unMedicament->id_medicament}}">
                    <button>Formuler</button>
                    <br>
                </a>
                <a href="{{ url('/listerPreciption') }}/{{  $unMedicament->id_medicament}}">
                    <button>prescription</button>
                    <br>
                </a>
                <a href="{{ url('/listeInteraction') }}/{{  $unMedicament->id_medicament}}">
                    <button>interagir</button>
                </a>
            </td>
            </tr>
        @endforeach
    </table>
    <script>
        function searchTable() {
            var input, filter, found, table, tr, td, i, j;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("search");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;
                } else {
                    if (tr[i].id !== 'tableHeader') {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@stop
