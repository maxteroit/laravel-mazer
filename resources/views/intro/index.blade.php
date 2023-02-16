<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">This is the main page.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Intro</h4>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="card-text">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                          + Intro
                        </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>SKILL</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($intros as $intro)
                        <tr>
                            <td class="text-bold-500">{{ $intro->title }}</td>
                            <td>{{ $intro->description }}</td>
                            <td class="text-bold-500">{{ $intro->image }}</td>
                            <td>
                                <a href="">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">
                Add New Intro
            </h4>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            </div>
            <form action="/intro" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <label>Title : </label>
                <div class="form-group">
                    <input type="text" placeholder="title" class="form-control" name="title">
                </div>
                <label>Description : </label>
                <div class="form-group">
                    <input type="text" placeholder="description" class="form-control" name="description">
                </div>
                <label>Image : </label>
                <div class="form-group">
                    <input class="form-control form-control-sm" id="formFileSm" type="file" onchange="handleImage(event)" name="image">
                    <!-- <input type="hidden" class="hidden-file" name="image" id="image-handler"> -->
                </div>
                <div class="form-group">
                    <label>Display Order :</label>
                    <input type="number" placeholder="display order" class="form-control" name="display_order">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Submit</span>
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>
</x-app-layout>
