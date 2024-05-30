@extends('layouts.layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<h3 class="border-bottom text-success">DashBoard</h3>

<div class="metric-row">
                    <div class="col-lg-9">
                      <div class="metric-row metric-flush"> 
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <span href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Examiners </h2>
                            <p class="metric-value h3">
                              <sub><i class="oi oi-people"></i></sub> <span class="value">{{ $examiners }}</span>
                            </p>
                          </span> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <span href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> courses </h2>
                            <p class="metric-value h3">
                              <sub><i class="oi oi-fork"></i></sub> <span class="value">{{ $courses }}</span>
                            </p>
                          </span> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <span href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Tests </h2>
                            <p class="metric-value h3">
                              <sub><i class="fa fa-tasks"></i></sub> <span class="value">{{ $tests }}</span>
                            </p>
                          </span> <!-- /.metric -->
                        </div><!-- /metric column -->
                      </div>
                    </div><!-- metric column -->
                    <div class="col-lg-3">
                      <!-- .metric -->
                      <span href="#" class="metric metric-bordered">
                        <div class="metric-badge">
                          <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> Students </span>
                        </div>
                        <p class="metric-value h3">
                          <sub><i class="oi oi-timer"></i></sub> <span class="value">{{$students}}</span>
                        </p>
                      </span> <!-- /.metric -->
                    </div><!-- /metric column -->
                  </div>
@endsection