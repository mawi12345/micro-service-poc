```sequence
User->Gateway: Request /demo
Note right of Gateway: /demo requires\nvalid JWT
Gateway-->>User: Redirect /auth\nSet redir cookie /demo
User->Gateway: Request /auth
Note right of Gateway: No JWT for\n/auth required
Gateway->Login:
Login-->>Gateway: Login Form
Gateway-->>User:
User->Gateway: Post cretentials
Gateway->Login:
Note right of Login: Redirect path\nis read from\n redir cookie
Login-->>Gateway: Redirect /demo\nSet JWT cookie
Gateway-->>User:
User->Gateway: Request /demo
Gateway->Demo:
Note right of Gateway: /demo JWT\nis valid
Demo-->>Gateway:
Gateway-->>User:
```
