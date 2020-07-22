/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import java.util.List;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

/**
 *
 * @author Cristian
 */
@Entity
@Table(name="Curso", schema="dayclass")
public class Curso implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaDesdeCurActual;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHastaCurActul;
    private String nombreCurso;
    
    @OneToMany
    private List<CargoProfesor> cargoProfesor;
    @ManyToOne
    private Division division;
    @ManyToOne
    private Materia materia;
    @OneToMany
    private List<HorarioCurso> horarioCurso;

    public Curso() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaDesdeCurActual() {
        return fechaDesdeCurActual;
    }

    public void setFechaDesdeCurActual(Date fechaDesdeCurActual) {
        this.fechaDesdeCurActual = fechaDesdeCurActual;
    }

    public Date getFechaHastaCurActul() {
        return fechaHastaCurActul;
    }

    public void setFechaHastaCurActul(Date fechaHastaCurActul) {
        this.fechaHastaCurActul = fechaHastaCurActul;
    }

    public String getNombreCurso() {
        return nombreCurso;
    }

    public void setNombreCurso(String nombreCurso) {
        this.nombreCurso = nombreCurso;
    }

    public List<CargoProfesor> getCargoProfesor() {
        return cargoProfesor;
    }

    public void setCargoProfesor(List<CargoProfesor> cargoProfesor) {
        this.cargoProfesor = cargoProfesor;
    }

    public Division getDivision() {
        return division;
    }

    public void setDivision(Division division) {
        this.division = division;
    }

    public Materia getMateria() {
        return materia;
    }

    public void setMateria(Materia materia) {
        this.materia = materia;
    }

    public List<HorarioCurso> getHorarioCurso() {
        return horarioCurso;
    }

    public void setHorarioCurso(List<HorarioCurso> horarioCurso) {
        this.horarioCurso = horarioCurso;
    }
    
}
