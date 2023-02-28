  <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <!-- <li>
                    <a href="index.php" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li> -->

                <?php if(is_admin()): ?>
                <li>
                    <a href="employees.php" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-chat">Employees</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span key="t-dashboards">Overview</span>
                    </a>
                </li> -->

                <li>
                    <a href="timesheet.php" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-chat">Timesheet</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->