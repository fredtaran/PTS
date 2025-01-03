<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Online Hospitals <span class="badge bg-blue hospital_online">0</span></h3>
    </div>

    <div class="panel-body">
        <div class="list-group">
            <?php $hospital_online_count = 0; ?>
            @foreach($hospitals as $row)
            <?php
                $class = 'danger';
                $text = '';
                if($row->login_status > 0){
                    $class = 'success';
                    $text = 'text-green';
                    $hospital_online_count++;
                }
            ?>
            <a href="#" class="list-group-item clearfix {{ $text }}" title="{{ $row->name }}">
                @if(strlen($row->name)>28)
                    {{ substr($row->name,0,28) }}...
                @else
                    {{ $row->name }}
                @endif
                <br><small class="text-yellow">({{ $row->province }})</small>
                <span class="pull-right">
                    <i class="fa fa-circle text-{{ $class }}"></i>
                </span>
            </a>
            @endforeach
            <?php Session::put('hospital_online_count',$hospital_online_count); ?>
        </div>

    </div>
</div>