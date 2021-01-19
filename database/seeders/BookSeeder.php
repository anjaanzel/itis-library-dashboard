<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = new Book();
        $book->title = 'To kill a mockingbird';
        $book->synopsis = 'To Kill a Mockingbird is Harper Lee’s 1961 Pulitzer Prize-winning novel about a child’s view of race and justice in the Depression-era South. The book sells one million copies per year, and Scout remains one of the most beloved characters in American fiction.';
        $book->author = 'Harper Lee';
        $book->genre = 'Southern Gothic';
        $book->logo_path = '../assets/img/theme/mockingbird.jpg';
        $book->no_of_issues = 8;

        $book->save();

        $book = new Book();
        $book->title = 'Robinson Crusoe';
        $book->synopsis = 'Robinson Crusoe was published in 1719 during the Enlightenment period of the 18th century. In the novel Crusoe sheds light on different aspects of Christianity and his beliefs. The book can be considered a spiritual autobiography as Crusoe\'s views on religion drastically change from the start of his story and then the end.';
        $book->author = 'Daniel Defoe';
        $book->genre = 'Robinsonadec';
        $book->logo_path = '../assets/img/theme/crusoe.jpg';
        $book->no_of_issues = 5;

        $book->save();

        $book = new Book();
        $book->title = 'Crime and punishment';
        $book->synopsis = 'Crime and Punishment was first published in the literary journal The Russian Messenger in twelve monthly installments during 1866. It was later published in a single volume. It is the second of Dostoevsky\'s full-length novels following his return from ten years of exile in Siberia. Crime and Punishment is considered the first great novel of his "mature" period of writing. The novel is often cited as one of the supreme achievements in literature';
        $book->author = 'Fyodor Dostoevsky';
        $book->genre = 'Philosophical';
        $book->logo_path = '../assets/img/theme/punishment.jpg';
        $book->no_of_issues = 12;

        $book->save();

        $book = new Book();
        $book->title = 'The Trial';
        $book->synopsis = 'The Trial  tells the story of Josef K., a man arrested and prosecuted by a remote, inaccessible authority, with the nature of his crime revealed neither to him nor to the reader.';
        $book->author = 'Franz Kafka';
        $book->genre = 'Philosophical';
        $book->logo_path = '../assets/img/theme/trial.jpg';
        $book->no_of_issues = 4;

        $book->save();

        $book = new Book();
        $book->title = 'Anna Karenina';
        $book->synopsis = 'A complex novel in eight parts, with more than a dozen major characters, it is spread over more than 800 pages (depending on the translation and publisher), typically contained in two volumes. It deals with themes of betrayal, faith, family, marriage, Imperial Russian society, desire, and rural vs. city life. The plot centers on an extramarital affair between Anna and dashing cavalry officer Count Alexei Kirillovich Vronsky that scandalizes the social circles of Saint Petersburg and forces the young lovers to flee to Italy in a search for happiness. After they return to Russia, their lives further unravel.';
        $book->author = 'Leo Tolstoy';
        $book->genre = 'Realist novel';
        $book->logo_path = '../assets/img/theme/karenina.jpg';
        $book->no_of_issues = 15;

        $book->save();
    }
}
