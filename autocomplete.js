const input = document.getElementById('input-box');
const suggestions = document.getElementById('autosuggest');

const books = [ 'The Eye of the World', 'Harry Potter and the Chamber of Secrets', 'The Name of the Rose', 'The Picture of Dorian Grey', 'Anna Karenina', 'Under the Yoke', 'Ema', 'Harry Potter and the Prisoner of Azkaban'];

function search(str) {
	let results = [];
	const val = str.toLowerCase();

	for (i = 0; i < books.length; i++) {
		if (books[i].toLowerCase().indexOf(val) > -1) {
			results.push(books[i]);
		}
	}

	return results;
}

function searchHandler(e) {
	const inputVal = e.currentTarget.value;
	let results = [];
	if (inputVal.length > 0) {
		results = search(inputVal);
	}
	showSuggestions(results, inputVal);
}

function showSuggestions(results, inputVal) {
    
    suggestions.innerHTML = '';

	if (results.length > 0) {
		for (i = 0; i < results.length; i++) {
			let item = results[i];
			// Highlights only the first match
			// TODO: highlight all matches
			const match = item.match(new RegExp(inputVal, 'i'));
			item = item.replace(match[0], `<strong>${match[0]}</strong>`);
			suggestions.innerHTML += `<li class="list-group-item">${item}</li>`;
		}
		suggestions.classList.add('has-suggestions');
	} else {
		results = [];
		suggestions.innerHTML = '';
		suggestions.classList.remove('has-suggestions');
	}
}

function useSuggestion(e) {
	input.value = e.target.innerText;
	input.focus();
	suggestions.innerHTML = '';
	suggestions.classList.remove('has-suggestions');
}

input.addEventListener('keyup', searchHandler);
suggestions.addEventListener('click', useSuggestion);
