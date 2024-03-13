<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>利用規約</title>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="/asset/css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>
@php use Carbon\Carbon; @endphp
<div class="header">
    <p class="text-center">{{ Carbon::now()->format('Y-m-d') }} Example test</p>
</div>
<div class="container">
    <div class="step">
        <ul>
            @foreach ($steps as $key => $step)
                <li class="{{ $active == $key ? 'active' : '' }}">{{ $step }}</li>
            @endforeach
        </ul>
    </div>

    <div class="form-step">
        <form action="">
            {{ csrf_field() }}
            <div class="">
                <select id="nameMeal" class="form-select" name="meal" aria-label="Default select example">
                    <option value="0" selected>-----</option>
                    @foreach($meal as $key => $item)
                        <option value="{{ $key }}" {{ $key == $dataStep1['meal'] ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <p class="error_msg" id="meal"></p>

            <div class="">
                <input type="number" min="1" max="10" name="count_people" value="{{ old('count_people', $dataStep1['count_people']) }}" class="form-control" aria-describedby="emailHelp">
            </div>
            <p class="error_msg" id="count_people"></p>

            <div class="form-group">
                <button class="btn btn-success btn-submit">Next</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $(".btn-submit").click(function(e){
            e.preventDefault();

            const _token = $("input[name='_token']").val();
            const count_people = $("input[name='count_people']").val();
            const nameMeal = $("#nameMeal option:selected").val()

            $.ajax({
                url: "{{ route('example.step1') }}",
                type:'POST',
                data: {
                    _token: _token,
                    count_people: count_people,
                    meal: nameMeal
                },
                success: function(data) {
                    if($.isEmptyObject(data.errors)){
                        $(".error_msg").html('');
                        alert(data.success);
                    }else{
                        let resp = data.errors;
                        for (index in resp) {
                            $("#" + index).html(resp[index]);
                        }
                    }
                }
            });

        });
    });


</script>

</body>
</html>
