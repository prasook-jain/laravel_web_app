<?php
/**
 * Created by PhpStorm.
 * User: PrasookDJ
 * Date: 2019-02-09
 * Time: 12:19
 */?>

@if($errors->any())
    <div class="container">
        @foreach($errors->all() as $err )
            <div class="alert alert-danger">
                {{ $err }}
            </div>
        @endforeach
    </div>
@endif
