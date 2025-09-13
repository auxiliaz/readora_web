# User Flow - Readora Admin Panel

```mermaid
flowchart TD

    A[Login Page] -->|Enter Email & Password| B[Dashboard]

    B --> C[Books CRUD]
    B --> D[Categories CRUD]
    B --> E[Reviews Management]
    B --> F[Profile]
    B --> G[Logout]

    %% Books CRUD
    C --> C1[Add Book]
    C --> C2[Edit Book]
    C --> C3[Delete Book]
    C --> C4[View Book List]

    %% Categories CRUD
    D --> D1[Add Category]
    D --> D2[Edit Category]
    D --> D3[Delete Category]
    D --> D4[View Category List]

    %% Reviews
    E --> E1[View Reviews List]
    E --> E2[Delete Review]

    %% Profile
    F --> F1[View Profile]
    F --> F2[Update Email/Password]

    %% Logout
    G --> H[Redirect to Login Page]
