<?php
session_start();

// index.php for news articles in an online store environment
// Project: Article Micro Transact v.001 (AMT)



$articles  = array(
		1 => array(
			'name' => 'Sports',
			'price' => '0.10',
			'category' => 'weekly',
			'date' => 'November 17th 2016',
			'summary' => 'A sports team dominated another sports team of like type on this day'
	),
	 	2 => array(
			'name' => 'Cover Story',
			'price' => '0.07',
			'category' => 'weekly',
			'date' => 'November 17th 2016',
			'summary' => 'Important news happened'
	),
	3 => array(
			'name' => 'Astrology & Comics',
			'price' => '0.05',
			'category' => 'weekly',
			'date' => 'November 17th 2016',
			'summary' => 'Hilarious Jokes'
	),
);
 // load Shopping cart function
 if (!isset($_SESSION['shopping_cart'])) {
	 $_SESSION['shopping_cart'] = array();
}
	 //empty_cart
	if (isset($_GET['empty_cart'])) {
		$_SESSION['shopping_cart'] = array();
	  }
		// add an article to the cart and take only 1 as argument
		//use article_id (may work in by date later)
		if(isset($_POST['add_to_cart'])) {
	echo "add to cart";
 echo "Article: " . $_POST['article_id'];
		}
	echo "<h2 style ='text-align:center;'>Breaking Gnus!</h2>";



if(isset($_GET['view_article'])) {
		$article_id = $_GET['view_article'];

		//view navigation
		echo "<p>
		<a href=' ./index.php'>Homepage</a> &gt; <a href=' ./index.php'>" .
		$articles[$article_id]['category'] . "</a></p>";
		echo "<p>
						<a href=' ./index.php?empty_cart=1'>Empty Cart</a>
					</p>";
     //Display the actual news page document as a product(to be purchased from here. . .)
		echo "<p>
						<span style= 'font-weight:bold;'>" . $articles[$article_id]['name'] . "</span><br />
						<span>$" . $articles[$article_id]['price'] . "</span><br />
						<span>" . $articles[$article_id]['date'] . "</span><br />
						<span>" . $articles[$article_id]['summary'] . "</span><br/>
							<p>
								<select name= 'quantity'>
								<option value='1'>1</option>
								</select>
								<form action=' ./index.php?view_article=$article_id' method= 'post'>
								<input type= 'hidden' name= 'article_id' value= '$article_id' />
								<input type= 'submit' name= 'add_to_cart' value= 'Add to Shopping Cart' />
								<p style='text-align:left;'><a href='./index.php?view_cart=1'> View Cart</a></p>
						</form>
						</p>
					</p>";
		}
		//view cart
else if(isset($_GET['view_cart'])) {
		echo "<h3 style= 'text-align: center;'> Shopping Cart:</h3>";
		echo "<span style='text-align:left;'><a href=' ./index.php?view_cart=1'>View Cart</a></span>
					<p><a href=' ./index.php'>Homepage</a></p>";
if(empty ($_SESSION['shopping_cart'])) {
				echo "you have no articles to read yet! <br />
				Visit the pages you like to get downloadable content";
			}


else {
	//display site navigation
		echo "<form action=' ./index.php?view_cart=1' method= 'post'>";
		echo  "<h3 style= 'text-align: center;'> Articles:</h3>";
		echo "<span style='text-align:left;'><a href=' ./index.php?view_cart=1'>View Cart</a></span>
					<p>
					<a href=' ./index.php'>Homepage</a></p>";
		echo "<table style='width:400px;' cellspacing='5'>";
		echo "<tr>
				<th style='border-bottom:1px solid #000000;'>Name</th>
				<th style='border-bottom:1px solid #000000;'>Price</th>
				<th style='border-bottom:1px solid #000000;'>date</th>
		</tr>";
		$total_price = 0;
			foreach($_SESSION['shopping_cart'] as $id => $article) {
				$article_id = $article['article_id'];


				$total_price += $articles[$article_id]['price'] * $article['quantity'];
				echo "<tr>
					<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_article=$id'>" .
						$articles[$article_id]['name'] . "</a></td>
					<td style='border-bottom:1px solid #000000;'>$" . $articles[$article_id]['price'] . "</td>
					<td style='border-bottom:1px solid #000000;'>" . $article['quantity'] . "</td>
					<td style='border-bottom:1px solid #000000;'>$" . ($articles[$article_id]['price'] * $article['quantity']) . "</td>
				</tr>";
			}
		echo "</table>
		<p>Total price: $" . $total_price . "</p>";

}
}
// View all products
else {
// Display site links
echo "<p>
	<a href='./index.php'>Homepage</a></p>";

	echo "<h3 style ='text-align:center;'>Articles:</h3>";
echo "<table style='width:500px;' cellspacing='0'>";
echo "<tr>
	<th style='border-bottom:1px solid #000000;'>Name</th>
	<th style='border-bottom:1px solid #000000;'>Price</th>
	<th style='border-bottom:1px solid #000000;'>Date</th>
</tr>";


		//loop to call articles
	foreach($articles as  $id => $article) {
			echo "<tr>
					<td style='border-bottom:1px solid #000000'><a href= './index.php?view_article=$id'>" . $article['name'] . "<a/></td>
					<td style='border-bottom:1px solid #000000'>$" . $article['price'] . "</td>
					<td style='border-bottom:1px solid #000000'>" . $article['date'] . "</td>
			</tr>";
		}
			echo "</table>";

	}
?>
