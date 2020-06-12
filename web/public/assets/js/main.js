// 5, 6
(() => document.addEventListener('DOMContentLoaded', function() {
	Array.from(document.getElementsByClassName('js-drop-tree')).forEach(function(tree) {
		let data = JSON.parse(tree.dataset.tree_data);
		// заполнение
		let tree_html = buildLevel(data, 0);
		tree.innerHTML = tree_html;
		// инициирование
		for (let handler of tree.querySelectorAll('.handler')) {
			if (handler != tree.children[0])
				handler.classList.add('hidden');
		}
		let disarmer;
		tree.addEventListener('click', function(e) {
			if (e.target.classList.contains('element')) {
				let handler = e.target.querySelector('.handler');
				if (handler !== null) {
					handler.classList.toggle('hidden');
					// чтобы закрыть не смотря на то, что мышь над элементом
					if (handler.classList.contains('hidden')) {
						handler.classList.add('extra-hidden');
						disarmer = disarmOnLeave.bind(null, handler);
						e.target.addEventListener('mouseleave', disarmer);
						e.target.addEventListener('click', disarmer);
					}
				}
				// так как открывается при наведении, фиксируем при клике для родителей
				let pn = e.target.parentNode;
				while (pn.classList.contains('handler')) {
					pn.classList.remove('hidden');
					pn = pn.parentNode.parentNode;
				}
			}
		});
		function disarmOnLeave(handler, e) {
			handler.classList.remove('extra-hidden');
			e.target.removeEventListener("mouseleave", disarmer);
			e.target.removeEventListener("click", disarmer);

		};
	});
	function buildLevel(data, deep) {
		let tree_html = "<div class=\"handler\">";
		if (typeof data == "object")
			for (let k in data) {
				if (typeof data[k] == "object" || typeof data[k] == "array") {
					tree_html += "<div class=\"element\">" + k + "";
					tree_html += buildLevel(data[k], deep + 1);
					tree_html += "</div>";
				} else
					tree_html += "<div class=\"element\">" + data[k] + "</div>";
			}
		else if (typeof data == "array") {
			data[k].forEach(function(item) {
				tree_html += "<div class=\"element\">" + data[k] + "</div>";
			});
		}
		return tree_html + "</div>";
	}
}))();