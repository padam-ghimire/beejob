@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">

        
    <form action="{{ route('jobs')}}" method="get">

        <div class="form-inline">
            <div class="form-group">
                <label>Keyword&nbsp;</label>
                <input type="text" name="title" id="" class="form-control">&nbsp;&nbsp;
            </div>

            <div class="form-group">
               <label for="title">Type:&nbsp;</label>
                <select name="type" class="form-control @error('type') is-invalid @enderror" id="">
                    <option disabled selected>-select-</option>

                    <option value="full_time">Full Time</option>
                    <option value="part_time">Part Time</option>
                    <option value="freelancing">Freelancer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="catgory">Category:</label>
                <select  name="category_id" id="" class="form-control @error('category') is-invalid @enderror" style="width: 120px;">
                    <option disabled selected>-select-</option>
                    @foreach (App\Category::all() as $category)
                         <option value="{{ $category->id }}">{{$category->name}}</option>
                    @endforeach
    
                </select>
            </div>

            <div class="form-group">
                <label>Address&nbsp;</label>
                <input width="10px" type="text" name="address" id="" class="form-control">&nbsp;
            </div>

            <div class="form-group">
               
                <button type="submit" class="btn btn-outline-info">Search</button>
               
            </div>
        
        </div>

    </form>




        {{-- <h1>Popular jobs</h1> --}}
        <table class="table bg-white">
            <thead border=0>
                
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                <td><img src="{{asset('uploads/company_logo')}}/{{$job->company->logo}}" width="70px" alt=""></td>
                    <td>position:{{$job->position}}
                        <br>
                        <i class="fa fa-clock-o" ></i>&nbsp;{{$job->type}}
                    </td>
                    <td><i class="fa fa-map-marker" aria-hidden="true"> </i>&nbsp;Address:{{$job->address}}</td>
                <td><i class="fa fa-globe" aria-hidden="true">&nbsp;{{$job->created_at->diffForHumans()}}</td>
                <td><a href="{{route('job.show',[$job->id,$job->slug])}}" class="btn btn-success btn-sm">Apply</a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $jobs->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
   
    </div>

</div>
@endsection
