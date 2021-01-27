const buttons = [
    {
        id: "quote_app_button",
        page: "quote.php"
    },
    {
        id: "db_app_button",
        page: "db_management.php"
    },
    {
        id: "quiz_app_button",
        page: "quiz.php"
    }
]

buttons.forEach(
    ({id,page}) => {
        document.getElementById(id).addEventListener(
            'click',
            () => {
                window.location.href = page;
            }
        )
    }
)