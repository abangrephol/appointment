<div class="panel panel-primary panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <button class="pull-right btn btn-sm btn-orange"><span class="fa fa-lock"></span>&nbsp;&nbsp;Lock time</button>
        </div>
        <h3 class="panel-title"></h3>Choose Time for <strong>"{{$service->name}}"</strong>
        <p id="service-date-{{$service->id}}"></p>

    </div>
    <div class="panel-footer">
        <div id="availableTime-{{$service->id}}">
            <div id="rt-{{$service->id}}-1" class="row mb5"></div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var businesshourData = JSON.parse('{{ $hour }}');
    var day = moment("{{ $date }}");
    var openHour='00:00',closeHour='00:00',open=false;;
    businesshourData.forEach(function(bhDay){
        if(day.format('ddd')==bhDay.day){
            openHour = bhDay.hourFrom;
            closeHour = bhDay.hourTo;
            open=true;
        }
    })
    if(open){
        $("#service-date-{{$service->id}}").html(day.format('dddd, DD MMMM YYYY'));
        var start = moment("{{ $date }}").hour(parseInt(openHour.split(':')[0])).minute(parseInt(openHour.split(':')[1]));
        var end = moment("{{ $date }}").hour(parseInt(closeHour.split(':')[0])).minute(parseInt(closeHour.split(':')[1]));
        var timeProc = moment("{{ $date }}").add(8, 'h').add(1,'s'),
            timeProcF = timeProc;
        var incC = 0,incR=1;
        while(timeProc.isAfter(start) && timeProcF.isBefore(end)){


            if(incC==6){
                incR++;
                $('#availableTime-{{$service->id}}').append('<div id="rt-{{$service->id}}-'+incR+'" class="row mb5"></div>');
            }
            var disabled='';
            if(timeProc.isBefore(moment()))
                disabled = 'disabled';
            $('#rt-{{$service->id}}-'+incR).append('<div class="col-sm-2 ">' +
                '<a class="btn-service-time btn btn-default btn-xs btn-block '+ disabled +' "' +
                'data-service-id="{{ $service->id }}"' +
                'data-service-name="{{ $service->name }}"' +
                'data-service-price="{{ $service->price }}"' +
                'data-service-time="'+timeProc.format('HH:mm')+'"' +
                'data-service-date="'+timeProc.format('YYYY-MM-DD')+'"' +
                'data-selected-text="<b>'+timeProc.format('hh:mm A')+'</b>"' +
                '>'+timeProc.format('hh:mm A')+'</a></div>');
            if(incC==6){
                //$('#availableTime-{{$service->id}}').append('</div>');

                incC=0;
            }
            incC++;
            timeProc.add({{$service->interval}},'m');
            timeProcF = moment(timeProc);

            timeProcF.add({{$service->interval}},'m');
        }
    }else{
        $('#rt-{{$service->id}}-1').append('<div class="text-center">Business close at this date.</div>')
    }



</script>