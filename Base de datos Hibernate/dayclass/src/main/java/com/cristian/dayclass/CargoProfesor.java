/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;

/**
 *
 * @author Leandro
 */
@Entity
@Table(name="CargoProfesor", schema="dayclass")
public class CargoProfesor implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaDesdeCargo;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHastaCargo;
    
    @ManyToOne
    private Profesor profesor;
    @ManyToOne
    private Cargo cargo;
    @ManyToOne
    private EstadoCargoProfesor estadoCargoProfesor;

    public CargoProfesor() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaDesdeCargo() {
        return fechaDesdeCargo;
    }

    public void setFechaDesdeCargo(Date fechaDesdeCargo) {
        this.fechaDesdeCargo = fechaDesdeCargo;
    }

    public Date getFechaHastaCargo() {
        return fechaHastaCargo;
    }

    public void setFechaHastaCargo(Date fechaHastaCargo) {
        this.fechaHastaCargo = fechaHastaCargo;
    }

    public Profesor getProfesor() {
        return profesor;
    }

    public void setProfesor(Profesor profesor) {
        this.profesor = profesor;
    }

    public Cargo getCargo() {
        return cargo;
    }

    public void setCargo(Cargo cargo) {
        this.cargo = cargo;
    }

    public EstadoCargoProfesor getEstadoCargoProfesor() {
        return estadoCargoProfesor;
    }

    public void setEstadoCargoProfesor(EstadoCargoProfesor estadoCargoProfesor) {
        this.estadoCargoProfesor = estadoCargoProfesor;
    }
    
    
    
}
