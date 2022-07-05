const booksSearch = document.getElementById("books-search");

if (booksSearch) {
    booksSearch.addEventListener("keyup", () => {
        const query = booksSearch.value.toLowerCase().trim();
        
        for (const book of document.querySelectorAll(".book")) {
            const bookName = book.querySelector(".book-name").innerText.toLowerCase().trim();
            
            if (bookName.includes(query)) {
                book.classList.remove("d-none");
            }
            else {
                book.classList.add("d-none");
            }
        }

        const notFound = document.querySelector("#gallery #not-found");

        if (document.querySelectorAll(".book:not(.d-none)").length == 0) {
            if (!notFound) {
                document.getElementById("gallery").insertAdjacentHTML(
                    "afterbegin", 
                    "<div id='not-found' class='fs-5 mt-5 text-center text-secondary w-100'>" +
                        "Nenhum livro encontrado para o termo pesquisado!" + 
                    "</div>")
            }
        }
        else {
            if (notFound) {
                notFound.remove();
            }
        }
    })
}