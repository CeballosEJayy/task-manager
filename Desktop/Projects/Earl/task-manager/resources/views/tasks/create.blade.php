<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task · Task Manager</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --black: #111111;
            --g-900: #1a1a1a;
            --g-700: #444444;
            --g-500: #767676;
            --g-300: #d9d9d9;
            --g-200: #e9e9e9;
            --g-100: #f4f4f4;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--white);
            color: var(--black);
            min-height: 100vh;
        }

        .header {
            background: var(--black);
            padding: 0 32px;
            height: 56px;
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

        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--g-500); }
        .breadcrumb a { color: var(--g-300); text-decoration: none; }
        .breadcrumb a:hover { color: var(--white); }
        .sep { color: var(--g-700); }

        .page { max-width: 560px; margin: 56px auto; padding: 0 24px; }

        .page-title { font-size: 19px; font-weight: 600; color: var(--black); margin-bottom: 4px; letter-spacing: -0.2px; }
        .page-sub { font-size: 13px; color: var(--g-500); margin-bottom: 32px; }

        .form-card {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid var(--g-200);
            padding: 28px;
        }

        .field { margin-bottom: 20px; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--g-700);
            margin-bottom: 7px;
            letter-spacing: 0.2px;
        }

        .req { color: var(--black); font-weight: 700; }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1px solid var(--g-300);
            border-radius: 8px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--black);
            background: var(--white);
            outline: none;
            transition: border-color 0.15s;
        }

        input::placeholder, textarea::placeholder { color: var(--g-500); }

        input:focus, textarea:focus {
            border-color: var(--black);
        }

        textarea { resize: vertical; min-height: 90px; line-height: 1.6; }

        .err {
            font-size: 12px;
            color: var(--black);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 500;
        }

        .divider { height: 1px; background: var(--g-200); margin: 22px 0; }

        .form-btns { display: flex; gap: 10px; }

        .btn-save {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--black);
            color: var(--white);
            padding: 11px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s;
        }
        .btn-save:hover { background: var(--g-900); }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--white);
            color: var(--g-700);
            border: 1px solid var(--g-300);
            padding: 11px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-cancel:hover { background: var(--g-100); }
    </style>
</head>
<body>

<header class="header">
    <div class="header-left">
        <div class="logo">
            <i data-lucide="check-square" style="width:16px;height:16px;"></i>
        </div>
        <span class="app-name">Task Manager</span>
    </div>
    <div class="breadcrumb">
        <a href="{{ route('tasks.index') }}">Dashboard</a>
        <span class="sep">/</span>
        <span style="color:white;">New Task</span>
    </div>
</header>

<div class="page">
    <div class="page-title">Create New Task</div>
    <div class="page-sub">Fill in the details below to add a new task.</div>

    <div class="form-card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="field">
                <label>Task Name <span class="req">*</span></label>
                <input type="text" name="task_name" value="{{ old('task_name') }}" placeholder="Enter task name...">
                @error('task_name')
                <div class="err">
                    <i data-lucide="alert-circle" style="width:12px;height:12px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description" placeholder="Describe the task in detail (optional)">{{ old('description') }}</textarea>
            </div>

            <div class="field">
                <label>Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}">
            </div>

            <div class="divider"></div>

            <div class="form-btns">
                <button type="submit" class="btn-save">
                    <i data-lucide="plus-circle" style="width:14px;height:14px;"></i>
                    Add Task
                </button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>