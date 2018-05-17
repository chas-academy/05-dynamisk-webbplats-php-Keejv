<?php
    namespace Blogg\Core;

class FilteredMap
{
    //Lagras som nyckelvärde och referensen heter map
    private $map;
    //Basemap kommer in som en array
    public function __construct(array $baseMap)
    {
        //returnerar mapen
        $this->map = $baseMap;
    }

    //Finns egenskapen ja eller nej, returnerar bool
    public function has(string $name): bool
    {
        return isset($this->map[$name]);
    }

    public function all()
    {
        return $this->map;
    }

    //Metod för att hämta ut namnet på någonting, tittar i map-propertyn
    public function get(string $name)
    {
        //?? = shorthand för is else
        //Returnera this map name om name finns i map name annars returnera null
        return $this->map[$name] ?? null;
    }

    //Ropar på get metoden i getInt
    public function getInt(string $name)
    {
        //Slänger om från sträng till heltal
        return (int) $this->get($name);
    }

    //
    public function getNumber(string $name)
    {
        //Returnerar float
        return (float) $this->get($name);
    }

    //Hämta ut strängvärde, skadlig input ska filtreras bort, alltså filtrerar inuti ett filter
    public function getString(string $name, bool $filter = true)
    {
        //Om den är satt till true, annars returnera value
        $value = (string) $this->get($name);
        return $filter ? addslashes($value) : $value;
    }
}

    //Appliceras som ett filter för request-klassen för att få ut rätt parametrar
