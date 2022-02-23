@extends('admin.base')

@php
    $title = 'show extracurricular';
@endphp
@section('title', Str::headline($title))

@section('content')
<div class="relative bg-gray-100 md:pt-32 pb-32 pt-12l w-full">
    <div class="px-4 md:px-10 mx-auto w-full">
        <x-card :title="Str::headline($title)">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="border-b border-2">
                                    <tr class="text-left">
                                        <th class=""></th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fields as $item)
                                    <tr class="border-b bg-white even:bg-gray-100 hover:bg-gray-100">
                                        <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{Str::headline($item)}}</td>
                                        @if ($item == 'image')
                                            <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <img src="{{url('storage/'.$model->$item)}}" alt="" class="h-96">
                                            </td>
                                        @else
                                            <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{$model->$item}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <x-link-cyan :link="route($routes['index'])" :id="'show'">Back</x-link-cyan>
            <x-link-amber :link="route($routes['edit'], $model)" :id="'edit'">Edit</x-link-amber>
            <x-link-rose :link="route($routes['show'], $model)" :id="'btn-delete-'.$model->id">
                Delete
            </x-link-rose>
            <form action="{{route($routes['destroy'], $model)}}" method="post" id="form-delete-{{$model->id}}">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
            </form>
        </x-card>
    </div>
</div>
@endsection

@section('js')
    <script>
        document.querySelector('#{{$title}}').classList.add('text-rose-500')
    </script>
    <script>
        var btn = document.getElementById('btn-delete-{{$model->id}}');
                btn.addEventListener('click', (e) => {
                    e.preventDefault()
                    swal({
                            title: "Are you sure?", 
                            text: "Once deleted, you will not be able to recover this record!", 
                            icon: "warning", 
                            buttons: true, 
                            dangerMode: true 
                        }).then((willDelete) => {
                            if (willDelete) {
                                document.getElementById('form-delete-{{$model->id}}').submit()
                            } else { 
                                swal({
                                    title: "Fyuuh!!!",
                                    text: 'Your record is safe!',
                                    icon: 'success'
                                }); 
                            } 
                        });
                })
    </script>
@endsection