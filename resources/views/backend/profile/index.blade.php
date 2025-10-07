@extends('backend.layout')
@section('backend_data')

@include('sweetalert2::index')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <!-- USER PROFILE -->
                <div class="col-md-4 mb-6 h-100">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h5 class="mb-1 me-2">User Profile</h5>
                            </div>

                            <div class="card-body p-0">
                                <form action="{{ route('profile.user.info.update') }}" method="post">
                                    @csrf
                                    @method('put')

                                    <label for="name">User Name</label>
                                    <input name="name" type="text" placeholder="name" class="form-control p-3 mb-3">

                                    <label for="email">User Email</label>
                                    <input name="email" type="text" placeholder="email" class="form-control p-3 mb-3">

                                    <button class="btn btn-primary p-7" type="submit">Update User Info</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- PROFILE IMAGE -->
                <div class="col-md-4 mb-6 h-100">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h5 class="mb-1 me-2">Profile Image</h5>
                            </div>

                            <div class="card-body p-0">
                                <form action="{{ route('profile.profile.update') }}" method="post" class="mt-3 text-center" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <label style="cursor: pointer" for="profile_image">

                                        @if (Auth::user()->profile_image)
                                            <img class="img-fluid" style="width: 180px" src="{{ asset('profile/' . Auth::user()->profile_image) }}" alt="">
                                        @else
                                            <img class="img-fluid" style="width: 180px" src="{{ asset('Images/profile.jpg') }}" alt="">
                                        @endif

                                    </label>

                                    <input name="profile_image" id="profile_image" hidden type="file">
                                    @error('profile_image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <button class="btn btn-primary mt-3 p-7" type="submit">Update Profile Image</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- PSSWORD --}}
                <div class="col-md-4 mb-6 h-100">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h5 class="mb-1 me-2">Password Update</h5>
                            </div>

                            <div class="card-body p-0">
                                <form action="" method="post" class="mt-3">
                                    @csrf

                                    <label for="name">Current Password : </label>
                                    <input type="password" name="current_password" placeholder="Current Password" class="form-control p-3 mb-3">

                                    <label for="name">New Password : </label>
                                    <input name="new_password" type="password" placeholder="New Password" class="form-control p-3 mb-3">

                                    <label for="name">Confirm Password</label>
                                    <input name="confirm_password" type="password" placeholder="New Password" class="form-control p-3 mb-3">

                                    <button class="btn btn-primary p-7">Update User Info</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- PSSWORD --}}
                <!--/ USER PROFILE -->

            </div>

        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>
@endsection
