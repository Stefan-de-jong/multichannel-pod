@extends('layouts.app')

@section('content')
    <div class="mx-auto w-full">
        <div>
            <!-- Card stats -->
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        Processed emails
                                    </h5>
                                    <span class="font-semibold text-xl text-gray-800">
                          {{ $emails }}
                        </span>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-500">
                                        <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                      <span class="text-red-500 mr-2">

                      </span>
                                <span class="whitespace-no-wrap">

                      </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        Processed attachments
                                    </h5>
                                    <span class="font-semibold text-xl text-gray-800">
                          {{ $attachments->count() }}
                        </span>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-500">
                                        <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                        <span class="text-orange-500 mr-2">

                        </span>
                        <span class="whitespace-no-wrap">

                        </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        Files ready for [OCR]
                                    </h5>
                                    <span class="font-semibold text-xl text-gray-800">
                          {{ count($processedFiles) }}
                        </span>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                      <span class="text-green-500 mr-2">
<a
    href="/results"
    >
                    Check results
                </a>
                      </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-12">
        <div class="flex">
            <h2 class="text-2xl font-medium mr-auto">Inbox</h2>
            <form role="form" onsubmit="return confirm('Collect email manually?');"
                  action="{{ action([\App\Http\Controllers\DashboardController::class, 'downloadAttachments']) }}"
                  method="POST">
            {{ csrf_field() }}
                <button type="submit" class="bg-blue-500 px-4 py-2 text-blue-50 rounded-md">Download attachments</button>
            </form>
        </div>

        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    Subject
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    Number of attachments
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($inboxMessages as $newMessage)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <svg class="h-10 w-10 rounded-full text-gray-500" fill="none"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                                </svg>
                                            </div>
                                            <div class="mx-2">
                                                <div
                                                    class="text-sm leading-5 font-medium text-gray-900"> {{$newMessage->getSubject()}}
                                                </div>
                                                <div
                                                    class="text-sm leading-5 text-gray-500">{{$newMessage->getFrom()}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{$newMessage->getAttachments()->count()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <div class="flex">
            <h2 class="text-2xl font-medium mr-auto">Images to crop</h2>
            <form role="form" onsubmit="return confirm('Crop images?');"
                  action="{{ action([\App\Http\Controllers\DashboardController::class, 'cropImages']) }}"
                  method="POST">
                {{ csrf_field() }}
                <button type="submit" class="bg-blue-500 px-4 py-2 text-blue-50 rounded-md">Crop images</button>
            </form>
        </div>
        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    File name
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    File size
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($files as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <svg class="h-10 w-10 rounded-full text-gray-500" fill="none"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
                                            <div class="mx-2">
                                                <div
                                                    class="text-sm leading-5 font-medium text-gray-900">{{ $file['name'] }}
                                                </div>
                                                <div
                                                    class="text-sm leading-5 text-gray-500">{{$file['extension']}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{$file['size']}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <div class="flex">
            <h2 class="text-2xl font-medium mr-auto">Cropped images to process</h2>
            <form role="form" onsubmit="return confirm('Process images? \n' +
             'Depending on the amount of files, this can take a while!');"
                  action="{{ action([\App\Http\Controllers\DashboardController::class, 'processImages']) }}"
                  method="POST">
                {{ csrf_field() }}
                <button type="submit" class="bg-blue-500 px-4 py-2 text-blue-50 rounded-md">Process images</button>
            </form>
        </div>
        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    File name
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    File size
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($croppedFiles as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <svg class="h-10 w-10 rounded-full text-gray-500" fill="none"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
                                            <div class="mx-2">
                                                <div
                                                    class="text-sm leading-5 font-medium text-gray-900">{{ $file['name'] }}
                                                </div>
                                                <div
                                                    class="text-sm leading-5 text-gray-500">{{$file['extension']}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{$file['size']}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
