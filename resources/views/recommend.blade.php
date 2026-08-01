<!-- @extends('user.header') -->

@section('content')

<div class="container mt-5">

    <h2 class="text-center mb-5">
        🎯 TOP 3 PHIM GỢI Ý CHO USER {{ $userId }}
    </h2>

    @foreach($recommendations as $index => $movie)

        <div class="card shadow mb-4">

            <div class="card-body">

                <h4>
                    @if($index==0)
                        🥇 GỢI Ý 1
                    @elseif($index==1)
                        🥈 GỢI Ý 2
                    @else
                        🥉 GỢI Ý 3
                    @endif
                </h4>

                <hr>

                <h5>
                    🎬 {{ $movie['title'] }}
                </h5>

                <p>
                    ⭐ <strong>Score:</strong>
                    {{ $movie['score'] }}
                </p>

                @if(isset($movie['confidence']))
                <p>
                    📈 <strong>Confidence:</strong>
                    {{ $movie['confidence'] }}%
                </p>
                @endif

                @if(isset($movie['lift']))
                <p>
                    🚀 <strong>Lift:</strong>
                    {{ $movie['lift'] }}
                </p>
                @endif

            </div>

        </div>

    @endforeach

</div>

@endsection