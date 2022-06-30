<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/Dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('teacher.stuents')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">الطلاب</span></a>
        </li>
        {{-- //attendce --}}
        <li>
            <a href="{{route('teacher.attendance')}}"><i class="fas fa-calendar-alt"></i><span
                    class="right-nav-text">الحضور والغياب</span></a>
        </li>
        <li>
            <a href="{{route('teacher.ReportAttendance')}}"><i class="fas fa-calendar-alt"></i><span
                    class="right-nav-text">تقرير الحضور والغياب</span></a>
        </li>


        <!-- الامتحانات-->
        <!-- Quizzes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">الاختبارات</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Quizzes.index')}}">قائمة الاختبارات</a> </li>
                <li> <a href="{{route('questions.index')}}">قائمة الاسئلة</a> </li>
            </ul>
        </li>

         <!-- Online classes-->
         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('online_classes.index')}}">حصص اونلاين مع زوم</a> </li>
            </ul>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">الملف الشخصي</span></a>
        </li>

    </ul>
</div>
