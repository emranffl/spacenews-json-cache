// import  $  from "jquery";

$ = require("jquery");

$(function () {
    $("button[data-button-type=close]").map((index, elem) => {
        $(elem).on("click", () => {
            $($(elem).attr("data-dismiss-target")).remove();
        });
    });
});

loadMoreCards = async () => {
    await fetch("/api/v1/loadmorecards", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            offset: $("[data-type=news-article]").length.toString(),
        },
    })
        .then((response) => response.json())
        .then(({ redirect, view, eod }) => {
            if (redirect) return (window.location.href = redirect);

            $("#card-containers").append(view);

            eod ? $("#load-more").remove() : null;
        })
        .catch((error) => console.error(error));
};
