<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --black:  #111111;
            --g-900:  #1a1a1a;
            --g-800:  #262626;
            --g-700:  #444444;
            --g-500:  #767676;
            --g-300:  #d9d9d9;
            --g-200:  #e9e9e9;
            --g-100:  #f4f4f4;
            --white:  #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--white);
            color: var(--black);
            min-height: 100vh;
            display: grid;
            grid-template-rows: 56px 1fr;
        }

        .header {
            background: var(--black);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left { display: flex; align-items: center; gap: 10px; }

        .logo {
            width: 30px; height: 30px;
            background: var(--white);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--black);
        }

        .app-name { font-size: 14px; font-weight: 600; color: var(--white); letter-spacing: 0.2px; }

        .header-right { display: flex; align-items: center; gap: 14px; }

        .header-date { font-size: 12px; color: var(--g-500); }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--white);
            color: var(--black);
            padding: 8px 15px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            font-family: inherit;
            transition: opacity 0.15s;
        }
        .btn-new:hover { opacity: 0.85; }

        .body {
            display: grid;
            grid-template-columns: 210px 1fr;
            min-height: 0;
        }

        .panel {
            background: var(--g-100);
            padding: 28px 16px;
            border-right: 1px solid var(--g-200);
        }

        .panel-label {
            font-size: 10px;
            font-weight: 700;
            color: var(--g-500);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 6px;
            background: var(--white);
            border: 1px solid var(--g-200);
        }

        .stat-item-left {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 12.5px;
            color: var(--g-700);
        }

        .stat-num { font-size: 17px; font-weight: 700; color: var(--black); }

        .panel-sep { height: 1px; background: var(--g-200); margin: 20px 0; }

        .panel-note { font-size: 11px; color: var(--g-500); line-height: 1.7; }

        .main { padding: 32px; overflow-y: auto; }

        .main-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .main-top h1 { font-size: 19px; font-weight: 600; color: var(--black); letter-spacing: -0.2px; }

        .total-chip {
            background: var(--g-100);
            color: var(--g-700);
            font-size: 11.5px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid var(--g-200);
        }

        .alert-bar {
            background: var(--g-100);
            border-left: 3px solid var(--black);
            color: var(--black);
            padding: 11px 16px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-wrap {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid var(--g-200);
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        thead { background: var(--g-100); }

        th {
            padding: 12px 18px;
            text-align: left;
            font-size: 10.5px;
            font-weight: 700;
            color: var(--g-700);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1px solid var(--g-200);
        }

        td {
            padding: 14px 18px;
            font-size: 13.5px;
            border-bottom: 1px solid var(--g-100);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--g-100); }

        tr.row-pending   td:first-child { border-left: 3px solid var(--g-500); }
        tr.row-completed td:first-child { border-left: 3px solid var(--black); }

        .t-name { font-weight: 600; color: var(--black); }
        .t-desc { font-size: 12px; color: var(--g-500); margin-top: 2px; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-pending   { background: var(--g-100); color: var(--g-700); }
        .badge-completed { background: var(--black);  color: var(--white); }

        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }
        .badge-pending   .badge-dot { background: var(--g-500); }
        .badge-completed .badge-dot { background: var(--white); }

        .acts { display: flex; gap: 6px; }

        .abtn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: opacity 0.15s;
        }
        .abtn:hover { opacity: 0.75; }

        .abtn-edit { background: var(--white); color: var(--g-700); border: 1px solid var(--g-300); }
        .abtn-done { background: var(--black); color: var(--white); }
        .abtn-undo { background: var(--g-200); color: var(--g-700); }
        .abtn-del  { background: var(--white); color: var(--black); border: 1px solid var(--g-300); }

        .empty { text-align: center; padding: 64px 24px; }

        .empty-box {
            width: 52px; height: 52px;
            background: var(--g-100);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: var(--g-700);
        }

        .empty h3 { font-size: 14.5px; font-weight: 600; color: var(--black); margin-bottom: 5px; }
        .empty p  { font-size: 13px; color: var(--g-500); }
    </style>
</head>
<body>

<header class="header">
    <div class="header-left">
        <div class="logo"><i data-lucide="check-square" style="width:16px;height:16px;"></i></div>
        <span class="app-name">Task Manager</span>
    </div>
    <div class="header-right">
        <span class="header-date">{{ now()->format('M d, Y') }}</span>
        <a href="{{ route('tasks.create') }}" class="btn-new">
            <i data-lucide="plus" style="width:13px;height:13px;"></i>
            New Task
        </a>
    </div>
</header>

<div class="body">
    <aside class="panel">
        <div class="panel-label">Overview</div>
        <div class="stat-item">
            <div class="stat-item-left">
                <i data-lucide="list" style="width:13px;height:13px;"></i>
                All Tasks
            </div>
            <span class="stat-num">{{ $counts['total'] }}</span>
        </div>
        <div class="stat-item">
            <div class="stat-item-left">
                <i data-lucide="clock" style="width:13px;height:13px;"></i>
                Pending
            </div>
            <span class="stat-num">{{ $counts['pending'] }}</span>
        </div>
        <div class="stat-item">
            <div class="stat-item-left">
                <i data-lucide="check-circle" style="width:13px;height:13px;"></i>
                Done
            </div>
            <span class="stat-num">{{ $counts['completed'] }}</span>
        </div>
        <div class="panel-sep"></div>
        <div class="panel-note">
            Dark border = Completed<br><br>
            Gray border = Pending
        </div>
    </aside>

    <main class="main">
        <div class="main-top">
            <h1>All Tasks</h1>
            <span class="total-chip">{{ $counts['total'] }} {{ $counts['total'] === 1 ? 'task' : 'tasks' }}</span>
        </div>

        @if(session('alert'))
        <div class="alert-bar">
            <i data-lucide="check-circle-2" style="width:14px;height:14px;flex-shrink:0;"></i>
            {{ session('alert') }}
        </div>
        @endif

        <div class="table-wrap">
            @if($records->isEmpty())
            <div class="empty">
                <div class="empty-box"><i data-lucide="inbox" style="width:24px;height:24px;"></i></div>
                <h3>No tasks found</h3>
                <p>Click <strong>New Task</strong> to add your first task.</p>
            </div>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr class="row-{{ strtolower($record->status) }}">
                        <td>
                            <div class="t-name">{{ $record->task_name }}</div>
                            @if($record->description)
                            <div class="t-desc">{{ $record->description }}</div>
                            @endif
                        </td>
                        <td style="font-size:13px;color:var(--g-500);">
                            {{ $record->due_date ? $record->due_date->format('M d, Y') : '—' }}
                        </td>
                        <td>
                            <span class="badge {{ $record->isCompleted() ? 'badge-completed' : 'badge-pending' }}">
                                <span class="badge-dot"></span>
                                {{ $record->status }}
                            </span>
                        </td>
                        <td>
                            <div class="acts">
                                <a href="{{ route('tasks.edit', $record) }}" class="abtn abtn-edit">
                                    <i data-lucide="pencil" style="width:11px;height:11px;"></i>
                                    Edit
                                </a>
                                <form action="{{ route('tasks.updateStatus', $record) }}" method="POST" style="display:inline">
                                    @csrf @method('PATCH')
                                    @if($record->isPending())
                                    <button type="submit" class="abtn abtn-done">
                                        <i data-lucide="check" style="width:11px;height:11px;"></i>
                                        Complete
                                    </button>
                                    @else
                                    <button type="submit" class="abtn abtn-undo">
                                        <i data-lucide="rotate-ccw" style="width:11px;height:11px;"></i>
                                        Reopen
                                    </button>
                                    @endif
                                </form>
                                <form action="{{ route('tasks.destroy', $record) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn abtn-del">
                                        <i data-lucide="trash-2" style="width:11px;height:11px;"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </main>
</div>

<script>lucide.createIcons();</script>
</body>
</html>