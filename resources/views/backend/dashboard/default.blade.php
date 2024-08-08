@extends('backend.layout.master')

@section('content')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: var(--blue-whale);">Welcome to UTAS Evaluation System</h1>
            </div>
        </div>

        <!-- System Overview -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: var(--tulip-tree); color: var(--iron);">
                        <h3 class="card-title">System Overview</h3>
                    </div>
                    <div class="card-body">
                        <p>The UTAS Evaluation System is designed to streamline the process of evaluating lecturers by
                            students. The system ensures a fair, efficient, and anonymous way for students to provide
                            feedback, which helps in enhancing the quality of education.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: var(--cabaret); color: var(--iron);">
                        <h3 class="card-title">How It Works</h3>
                    </div>
                    <div class="card-body">
                        <p>The UTAS Evaluation System allows students to anonymously evaluate their lecturers at the end of
                            each semester. The evaluations are then reviewed by the Quality Assurance team to ensure that
                            the feedback is used to improve the quality of teaching. Here are the steps:</p>
                        <ol>
                            <li>Students log in to the system using their credentials.</li>
                            <li>They complete evaluation forms for each of their lecturers.</li>
                            <li>The evaluations are submitted anonymously to ensure privacy.</li>
                            <li>The Quality Assurance team reviews the evaluations and generates reports.</li>
                            <li>The feedback is used to improve the teaching quality and address any issues.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: var(--teal-blue); color: var(--iron);">
                        <h3 class="card-title">Contact Information</h3>
                    </div>
                    <div class="card-body">
                        <p>If you have any questions or need more information, please contact us at:</p>
                        <p>Email: support@utas.edu</p>
                        <p>Phone: (123) 456-7890</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login/Signup Links -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="{{ url('login') }}" class="btn btn-primary m-2">Login</a>
                <a href="{{ url('register') }}" class="btn btn-secondary m-2">Sign Up</a>
            </div>
        </div>
    </div>
@endsection
