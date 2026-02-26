@extends('frontend.dashboard.layouts.master')
@section('title', 'My Purchases')
@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>Purchases</h5>
                <p>Your purchase Items.</p>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">
                            #
                        </th>
                        <th class="details">
                            Details
                        </th>
                        <th class="p_date">
                            Purchase Date
                        </th>
                        <th class="price">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                        <tr>
                            <td>#{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                        @if ($purchase->item->preview_type == 'image')
                                            <a href="javascript:;" class="link">
                                                <img src="{{ asset($purchase->item->preview_image) }}" alt=""
                                                    class="cover-img">
                                            </a>
                                        @elseif($purchase->item->preview_type == 'video')
                                            <a href="javascript:;" class="link">
                                                <img src="{{ asset('defaults/video.webp') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                        @elseif($purchase->item->preview_type == 'audio')
                                            <a href="javascript:;" class="link">
                                                <img src="{{ asset('defaults/audio.webp') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-2">{{ $purchase->item->name }}</h6>
                                        <span>{{ $purchase->item->category->name }} /
                                            {{ $purchase->item->subCategory->name }}</span>
                                        @for ($index = 0; $index < 5; $index++)
                                            <span class="d-inline-block">
                                                <i class="fa fa-star"></i>
                                            </span>
                                        @endfor
                                        <p><a href="">(write a review)</a></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>{{ formatDate($purchase->created_at, true) }}</p>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('orders.show', $purchase->id) }}" class="btn btn-sm btn-primary"><i
                                        class="ti ti-eye"></i></a>
                                <a href="{{ route('items.download', $purchase->item->id) }}"
                                    class="btn btn-sm btn-success"><i class="ti ti-download"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data Found</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div>
            {{ $purchases->links() }}
        </div>
    </div>
@endsection
