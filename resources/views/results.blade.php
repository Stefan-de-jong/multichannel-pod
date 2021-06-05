@extends('layouts.app')

@section('content')
    <div class="mx-auto w-full">
        <div class="mt-12">

            <h2 class="text-2xl font-medium mr-auto">Results</h2>
            <section class="py-8 px-4">
                <div class="flex flex-wrap -mx-4 -mb-8">
                    @foreach($files as $file)
                        <div class="md:w-1/4 px-4 mb-8">
                            <img class="shadow-md transform scale-150" src="{{asset('storage/output/' . $file['name'] . '.' . $file['extension'])}}" alt="">
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
@endsection
