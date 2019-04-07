# evote-movie-2019-18-movie-charts-many-to-many

Part of the progressive Movie Voting website project at: https://github.com/dr-matt-smith/evote-movie-2019

This project illiustrates working with **many-to-many** relationships, resolved via a **link table**:

- Chart (e.g. `online`)

- Movie

- ChartMovie has the `id`s of each `Chart` and `Movie` pair, e.g.

    ```
         online - Jaws
         online - Alien
         online - Forget Paris
    ```


The project has been refactored as follows:

- Created `Chart` class (with `id` and `name`), and a `ChartRepository`

    ```php
          class Chart
          {
              private $id;
              private $name;

              (and public getters / setters)
    ```

- Create 'ChartMovie' class (with `id`, `chartId`, `movieId`) and a `ChartMovieRepository`

    ```php
      class ChartMovie
      {
          private $id;
          private $movieId;
          private $chartId;
        
          (and public getters / setters)
    ```
    
- added `getMovie()` and `getChart()` methods for class `ChartMovie`:

    ```php
          /**
           * return Chart object value of `chartId` in this object
           */
          public function getChart()
          {
              $chartRepository = new ChartRepository();
              $chart = $chartRepository->getOneById($this->chartId);
      
              return $chart;
          }
      
          /**
           * return Movie object value of `movieId` in this object
           */
          public function getMovie()
          {
              $movieRepository = new MovieRepository();
              $movie = $movieRepository->getOneById($this->movieId);
      
              return $movie;
          }
    ```

- added SQL for tables `chart` and `chartmovie`:

    ```sql
        -- create the table
        create table if not exists chart (
            id integer primary key AUTO_INCREMENT,
            name text
        );
        
        -- insert some data
        insert into chart values (1, 'online');
        insert into chart values (2, 'dvd');
        
        -- create the table
        create table if not exists chartmovie (
            id integer primary key AUTO_INCREMENT,
            chartId integer,
            movieId integer
        );
        
        -- insert some data
        insert into chartmovie values (1, 1, 1); -- online - Jaws
        insert into chartmovie values (2, 1, 3); -- online - Alien
        insert into chartmovie values (3, 1, 6); -- online - Forget Paris
        insert into chartmovie values (4, 2, 3); -- dvd - Alien
        insert into chartmovie values (5, 2, 2); -- dvd - Jaws2
        insert into chartmovie values (6, 2, 8); -- dvd - Sound of Music
    ```
    
- add to class `Chart` a method ` getChartMovies()`, that returns an array of `ChartMovie` objects for the current `Chart`s Id:

    ```php
          /**
           * get array of ChartMovie objects for current Chart's ID
           */
          public function getChartMovies()
          {
              $chartMovieRepository = new ChartMovieRepository();
              $chartMovies = $chartMovieRepository->getAll();
      
              $chartMoviesForThisChart = [];
              foreach ($chartMovies as $chartMovie){
                  if($this->id == $chartMovie->getChartId()){
                      $chartMoviesForThisChart[] = $chartMovie;
                  }
              }
      
              return $chartMoviesForThisChart;
          }
    ```
    
- add a new nav bar link for `index.php&action=charts`:

    ```php
          <li>
              <a href="index.php" class="<?= $homePageStyle ?>">Home</a>
          </li>
  
          <li>
              <a href="index.php?action=about"  class="<?= $aboutPageStyle ?>">About Us</a>
          </li>
  
          <li>
              <a href="index.php?action=list"  class="<?= $listPageStyle ?>">Movie ratings</a>
          </li>
  
          <li>
              <a href="index.php?action=listCheap"  class="<?= $listCheapPageStyle ?>">cheap movies</a>
          </li>
  
          <li>
              <a href="index.php?action=contact"  class="<?= $contactPageStyle ?>">Contact Us</a>
          </li>
  
          <li>
              <a href="index.php?action=sitemap"  class="<?= $sitemapPageStyle ?>">Site Map</a>
          </li>
  
          <li>
              <a href="index.php?action=charts"  class="<?= $chartPageStyle ?>">Charts</a>
          </li>
    ```
    
- add 2 new routes to the `public/index.php` Front Controller. The `charts` action will list each chart, and the `chartList` action will list all movies for the chart whose ID is given:

    ```php
      $chartController = new ChartController();
      switch ($action){
          // ------ chart movies section --------
          case 'charts':
              $chartController->charts();
              break;
      
          case 'chartList':
              $id = filter_input(INPUT_GET, 'id');
              $chartController->chartList($id);
              break;
    ```
    
    - note how, in this example, we retrieve the `id` GET variable, as pass is as a paremeter to the `chartList()` method
    
        - this simplifies the Controller code, but means more work is done in the Front Controller
    
- we need to crete a `src/ChartController.php` class with methods `charts()` and `chartList(<id>)`:

    ```php
      namespace TuDublin;
      
      class ChartController
      {
          public function charts()
          {
              $chartRepository = new ChartRepository();
              $charts = $chartRepository->getAll();
      
              $pageTitle = 'charts';
              $chartPageStyle = "current_page";
      
              require_once __DIR__ . '/../templates/charts.php';
          }
      
          public function chartList($id)
          {
              $chartRepository = new ChartRepository();
              $chart = $chartRepository->getOneById($id);
      
              $chartMovies = $chart->getChartMovies();
      
              $pageTitle = 'chart list';
      
              require_once __DIR__ . '/../templates/chartList.php';
          }
      }
    ```
    
- we create a `templates/charts.php` template to list each chart, as a link to `index.php?action=chartList&id=<chartId>`:

    ```php
      <h1>Charts</h1>
      <ul>
      <?php
          foreach($charts as $chart):
      ?>
          <li>
              <a href="index.php?action=chartList&id=<?= $chart->getId()?>">
                  <?= $chart->getName() ?>
              </a>
          </li>
      
      <?php
        endforeach;
      ?>
      </ul>
    ```
    
- and we create template `templates/chartList.php` to list all `ChartMovie` records for the given `Chart`:

    ```php
      <h1>Chart: <?= $chart->getName() ?></h1>
      <ul>
      
      <?php
          foreach($chartMovies as $chartMovie):
      ?>
          <li>
              <?= $chartMovie->getMovie()->getTitle() ?>
          </li>
      
      <?php
        endforeach;
      ?>
      </ul>
    ```
    
    
## Alternative approach - custom method in `ChartMovieRepsitory`

Rather than having the `Chart` class methgod 

We can write a custom method in `ChartMovieRepository`, which accepts a `chartId` and returns all `chartmovie` recoreds from the DB:

```php
namespace TuDublin;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;
use Mattsmithdev\PdoCrudRepo\DatabaseManager;

class ChartMovieRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__, 'ChartMovie', 'chartmovie');
    }


    public function getAllForChartId($id)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM chartmovie WHERE chartId = :chartId';

        $statement = $connection->prepare($sql);
        $statement->bindParam(':chartId', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->getClassNameForDbRecords());
        $statement->execute();

        $chartMovies = $statement->fetchAll();

        return $chartMovies;
    }
}
```

So our alternative code for `ChartController` method `chartList(<id>)` would look as follows:

```php
    public function chartListFromRepository($id)
    {
        $chartRepository = new ChartRepository();
        $chart = $chartRepository->getOneById($id);

        // get chart moviers from repository
        $chartMovieRepository = new ChartMovieRepository();
        $chartMovies = $chartMovieRepository->getAllForChartId($id);

        $pageTitle = 'chart list';

        require_once __DIR__ . '/../templates/chartList.php';
    }
```

We can seamless switch between these approaches by changing which controller method is used in our Front Controller:

```php
    case 'chartList':
        $id = filter_input(INPUT_GET, 'id');
        
        $chartController->chartList($id);

//        $chartController->chartListFromRepository($id);

        break;

```