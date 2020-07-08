@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if ($count==0)
              <p>Your jobs has not been applied yet.</p>
          @else
          @foreach ($applications as $application)
          <div class="card">

          <div class="card-header">{{\App\Job::find($application['job_id'])->title}}</div>
              <div class="card-body">
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Rank</th>
                          <th scope="col">name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Address</th>
                          <th scope="col">Bio</th>
                          <th scope="col">Similarity</th>
                          <th scope="col">resume</th>
                          <th scope="col">cover</th>
                        </tr>
                      </thead>
                      <tbody>
                  @foreach ($application['bios'] as $bio)
                    @php($user=\App\User::find($bio->id))
                    
                        <tr>
                        <th>{{ $loop->iteration}}</th>
                          
                        <th>{{ $user->name}}</th>
                          <td>{{ $user->email}}</td>
                          <td>{{ $user->profile->address}}</td>
                          <td>{{ $user->profile->bio}}</td>
                        <td>{{number_format($bio->similarity*100,2)}}%</td>
                          @if($user->profile->resume)
                          <td><a href="{{ Storage::url($user->profile->resume)}}" download="">Download </a></td>
                          @else 
                          <td>No resume found</td>

                          @endif

                          @if($user->profile->cover_letter)
                          <td><a href="{{ Storage::url($user->profile->cover_letter)}}" download="">Download</a></td>
                          @else 
                          <td>No cover letter found found</td>

                          @endif

                        </tr>
                     @endforeach

                      </tbody>
                    </table>


                  </div>
                </div>
                <br>
                @endforeach
          @endif
          
        </div>
    </div>
</div>
@endsection
