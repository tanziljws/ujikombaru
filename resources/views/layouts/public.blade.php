<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMKN 4')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts: Modern Font Pairing -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Modern Design System */
        :root {
            /* Color Palette */
            --bs-primary: #2563eb;      /* Modern blue */
            --bs-secondary: #64748b;    /* Slate gray */
            --bs-success: #059669;     /* Green */
            --bs-info: #0891b2;        /* Cyan */
            --bs-warning: #d97706;     /* Amber */
            --bs-danger: #dc2626;      /* Red */
            --bs-light: #f8fafc;       /* Light background */
            --bs-dark: #0f172a;        /* Dark text */

            /* Typography */
            --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-heading: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            
            /* Spacing Scale */
            --space-xs: 0.25rem;    /* 4px */
            --space-sm: 0.5rem;     /* 8px */
            --space-md: 1rem;       /* 16px */
            --space-lg: 1.5rem;     /* 24px */
            --space-xl: 2rem;       /* 32px */
            --space-2xl: 3rem;      /* 48px */
            --space-3xl: 4rem;      /* 64px */
            
            /* Border Radius */
            --radius-sm: 0.375rem;   /* 6px */
            --radius-md: 0.5rem;    /* 8px */
            --radius-lg: 0.75rem;   /* 12px */
            --radius-xl: 1rem;      /* 16px */
            --radius-2xl: 1.5rem;   /* 24px */
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            /* Transitions */
            --transition-fast: 150ms ease-in-out;
            --transition-normal: 300ms ease-in-out;
            --transition-slow: 500ms ease-in-out;
        }

        body {
            background: var(--bs-light);
            color: var(--bs-dark);
            font-family: var(--font-primary);
            font-size: 1rem;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Typography Hierarchy */
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 600;
            line-height: 1.2;
            color: var(--bs-dark);
            margin-bottom: var(--space-md);
        }
        
        h1 { font-size: 2.5rem; font-weight: 700; }
        h2 { font-size: 2rem; font-weight: 600; }
        h3 { font-size: 1.75rem; font-weight: 600; }
        h4 { font-size: 1.5rem; font-weight: 500; }
        h5 { font-size: 1.25rem; font-weight: 500; }
        h6 { font-size: 1.125rem; font-weight: 500; }

        /* Button System */
        .btn {
            font-family: var(--font-primary);
            font-weight: 500;
            border-radius: var(--radius-md);
            transition: var(--transition-normal);
            padding: var(--space-sm) var(--space-lg);
            border: none;
            cursor: pointer;
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, var(--bs-primary) 0%, #1d4ed8 100%);
            color: white;
            box-shadow: var(--shadow);
        }
        .btn-primary:hover { 
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-secondary { 
            background: var(--bs-secondary);
            color: white;
        }
        .btn-secondary:hover { 
            background: #475569;
            transform: translateY(-2px);
        }
        
        .btn-success { 
            background: var(--bs-success);
            color: white;
        }
        .btn-success:hover { 
            background: #047857;
            transform: translateY(-2px);
        }
        
        .btn-info { 
            background: var(--bs-info);
            color: white;
        }
        .btn-info:hover { 
            background: #0e7490;
            transform: translateY(-2px);
        }
        
        .btn-warning { 
            background: var(--bs-warning);
            color: var(--bs-dark);
        }
        .btn-warning:hover { 
            background: #b45309;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-danger { 
            background: var(--bs-danger);
            color: white;
        }
        .btn-danger:hover { 
            background: #b91c1c;
            transform: translateY(-2px);
        }

        /* Cards and containers */
        .card { 
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            transition: var(--transition-normal);
            background: white;
        }
        
        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }
        
        .container-narrow { max-width: 1080px; }
    </style>
</head>
<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
